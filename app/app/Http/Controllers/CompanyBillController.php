<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyBill;
use App\CompanyCycleBill;
use App\CustomerCompany;
use App\Library\Sms;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

/**
 * 收款管理
 * @package App\Http\Controllers
 * @version 1.0
 * @author  Minco
 */
class CompanyBillController extends BaseController
{
    /**
     * 列出当前客户所有待收款项
     * @author Minco <root@lostman.org>
     * @param Request $request
     * @param $companyId
     * @return $this
     */
    public function getAllBills(Request $request, $companyId)
    {
        $bills = array();
        if ($request['type'] == null or $request['type'] == 'normal') {
            $map = [
                //'is_paid' => CompanyBill::IS_PAID_NO,
                'user_id' => Session::get('company_id'),
                'company_id' => $companyId
            ];
            $bills = CompanyBill::where($map)->orderBy('deadline', 'desc')->get();
        }
        if ($request['type'] == 'cycle') {
            $map = [
                'user_id' => Session::get('company_id'),
                'company_id' => $companyId
            ];
            $bills = CompanyCycleBill::where($map)->orderBy('id', 'desc')->get();
        }
        return view('customer.bill.index')->with('bills', $bills);

    }

    /**
     * 列出所有公司待收款项概况
     * @author Minco <root@lostman.org>
     */
    public function getSummaryUnpaidBills(Request $request)
    {
        $userId = (int)(Session::get('company_id'));
        $allNum = 0;
        $unpaidNum = 0;
        $cycleNum = 0;
        $result = array();
        $unpaidResult = array();

        $cycleBillCompanyIds = CompanyCycleBill::where('user_id', $userId)->distinct()->lists('company_id');
        $cycleNum = count($cycleBillCompanyIds);
        $allNum = CustomerCompany::where('user_id', $userId)->count();
        if ($request['type'] == null or $request['type'] == 'unpaid') {
            $sql = "SELECT c.id, c.name, sum(cb.grand_total) as grand_total, count(c.id) as total_item FROM company_bills cb LEFT JOIN companies c ON cb.company_id = c.id where cb.is_paid=0 and cb.user_id=$userId GROUP BY(c.id);";
            $unpaidResult = DB::select($sql);
            foreach ($unpaidResult as $i => $r) {
                if ($cycleBillCompanyIds->contains($r->id)) {
                    $unpaidResult[$i]->has_cycle = true;
                } else {
                    $unpaidResult[$i]->has_cycle = false;
                }
            }
            $result = $unpaidResult;
        }

        if ($request['type'] == 'all') {
            $unpaidSql = "SELECT c.id, c.name, sum(cb.grand_total) as grand_total, count(c.id) as total_item FROM company_bills cb LEFT JOIN companies c ON cb.company_id = c.id where cb.is_paid=0 and cb.user_id=$userId GROUP BY(c.id);";
            $unpaidResult = DB::select($unpaidSql);
            $whereInString = '';

            foreach ($unpaidResult as $r) {
                $whereInString .= $r->id . ",";
            }
            $whereInString = trim($whereInString, ",");
            if ($whereInString) {
                $whereInString = "and c.id not in ($whereInString)";
            }
            $allSql = "SELECT c.id, c.name, 0 as grand_total, 0  as total_item FROM  companies c where c.user_id=$userId $whereInString ;";
            $allResult = DB::select($allSql);
            $result = array_merge($unpaidResult, $allResult);
            foreach ($result as $i => $r) {
                if ($cycleBillCompanyIds->contains($r->id)) {
                    $result[$i]->has_cycle = true;
                } else {
                    $result[$i]->has_cycle = false;
                }
            }
            $unpaidNum = count($unpaidResult);

        }

        if ($request['type'] == 'cycle') {
            $unpaidSql = "SELECT c.id, c.name, sum(cb.grand_total) as grand_total, count(c.id) as total_item FROM company_bills cb LEFT JOIN companies c ON cb.company_id = c.id where cb.is_paid=0 and cb.user_id=$userId GROUP BY(c.id);";
            $unpaidResult = DB::select($unpaidSql);
            $whereInString = '';
            foreach ($unpaidResult as $r) {
                $whereInString .= $r->id . ",";
            }
            $whereInString = trim($whereInString, ",");
            if ($whereInString) {
                $whereInString = "and c.id not in ($whereInString)";
            }
            $allSql = "SELECT c.id, c.name, 0 as grand_total, 0  as total_item FROM  companies c where c.user_id=$userId $whereInString ;";
            $allResult = DB::select($allSql);
            $result = array_merge($unpaidResult, $allResult);
            foreach ($result as $i => $r) {
                if ($cycleBillCompanyIds->contains($r->id)) {
                    $result[$i]->has_cycle = true;
                } else {
                    unset($result[$i]);
                }
            }
        }
        $unpaidNum = count($unpaidResult);
        return view('bill.index')
            ->with('companyBills', $result)
            ->with('unpaidNum', $unpaidNum)
            ->with('allNum', $allNum)
            ->with('cycleNum', $cycleNum);
    }

    /**
     * 短信催款
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function sendBillNotice(Request $request)
    {

        $input = $request->only('companyId', 'grand_total', 'total_item');

        $rules = [
            'companyId' => 'required',
            'grand_total' => 'required|numeric|min:0',
            'total_item' => 'required|numeric|min:0'
        ];
        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            Session::flash('error', $v->messages()->first());
            return redirect()->back()->with($input);
        }
        $map = [
            'user_id' => Session::get('company_id'),
            'id' => $input['companyId']
        ];

        $customerCompany = CustomerCompany::where($map)->first();
        if (!$customerCompany) {
            Session::flash('error', '公司不存在,非法操作');
            return redirect()->back()->withInput($request->all());
        }
        $contact = $customerCompany->getDefaultContact();
        if (!$contact) {
            Session::flash('error', '公司联系人不存在,无法发送短信');
            return redirect()->back()->withInput($request->all());
        }

        $company = Company::where('id', Session::get('company_id'))->first();
        if (!$company) {
            Session::flash('error', '代账用户不存在');
            return redirect()->back()->withInput($request->all());
        }
        $grandTotal = $input['grand_total'];
        $totalItem = $input['total_item'];
        $sms = new Sms();
        //TODO 不存在短信模板，需要增加模板才可发送。
        $text = "【代账通】尊敬的客户，贵公司尚有未支付费用 $totalItem 项，共计 ¥$grandTotal 元 。请及时联系 $company->name 缴纳。";
        $result = $sms->sendMessage($text, $contact->mobile);
        if ($result->code != 0) {
            Session::flash('error', '发送失败, 网关异常');
            return redirect()->back()->withInput($request->all());
        }

        Session::flash('success', '催款短信发送成功');
        return redirect()->back()->withInput($request->all());

    }


    public function toAddBill($companyId)
    {
        //TODO 页面显示常用项目
        return view('customer.bill.create');
    }

    /**
     * 增加收款项
     * @param Request $request
     * @param $companyId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addBill(Request $request, $companyId)
    {

        $input = $request->only('item', 'grand_total', 'deadline', 'remarks');

        $rules = [
            'item' => 'required',
            'grand_total' => 'required|numeric|min:1',
            'deadline' => 'required|date'
        ];

        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            Session::flash('error', $v->messages()->first());
            return redirect()->back()->with($input);
        }

        $bill = new CompanyBill();
        $bill->item = $input['item'];
        $bill->user_id = Session::get('company_id');
        $bill->remarks = $input['remarks'];
        $bill->company_id = $companyId;
        $bill->operator_id = Auth::user()->id;
        $bill->grand_total = $input['grand_total'];
        $bill->deadline = $input['deadline'];
        $bill->save();
        Session::flash('success', '添加收款项成功');
        return redirect(action('CompanyBillController@getAllBills', $companyId));
    }

    /**
     * 去编辑收款项页面
     * @param Request $request
     * @param $companyId
     * @param $id
     * @return $this
     */
    public function toUpdateBill(Request $request, $companyId, $id)
    {
        $map = [
            'user_id' => Session::get('company_id'),
            'company_id' => $companyId,
            'id' => $id
        ];
        try {
            $bill = CompanyBill::where($map)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            Session::flash('error', '收款项不存在,非法操作');
            return redirect()->back()->withInput($request->all());
        }
        if ($bill->is_paid == CompanyBill::IS_PAID_YES) {
            Session::flash('error', '已收款，不可编辑');
            return redirect()->back()->withInput($request->all());
        }
        return view('customer.bill.update')->with('bill', $bill);
    }

    /**
     * 去收款页面
     * @param Request $request
     * @param $companyId
     * @param $id
     * @return $this
     */
    public function toPayBill(Request $request, $companyId, $id)
    {
        $map = [
            'user_id' => Session::get('company_id'),
            'company_id' => $companyId,
            'id' => $id
        ];
        try {
            $bill = CompanyBill::where($map)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            Session::flash('error', '收款项不存在,非法操作');
            return redirect()->back()->withInput($request->all());
        }
        if ($bill->is_paid == CompanyBill::IS_PAID_YES) {
            Session::flash('error', '已收款，无需再次收款');
            return redirect()->back()->withInput($request->all());
        }
        return view('customer.bill.pay')->with('bill', $bill);
    }

    public function payBill(Request $request, $companyId, $id)
    {

        $input = $request->only('paid_date', 'amount_tendered', 'is_invoice', 'remarks');
        $rules = [
            'amount_tendered' => 'required|numeric|min:0',
            'paid_date' => 'required|date'
        ];

        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            Session::flash('error', $v->messages()->first());
            return redirect()->back()->with($input);
        }

        $map = [
            'user_id' => Session::get('company_id'),
            'company_id' => $companyId,
            'id' => $id
        ];
        try {
            $bill = CompanyBill::where($map)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            Session::flash('error', '收款项不存在,非法操作');
            return redirect()->back()->withInput($request->all());
        }
        if ($bill->is_paid == CompanyBill::IS_PAID_YES) {
            Session::flash('error', '已收款，无需再次收款');
            return redirect()->back()->withInput($request->all());
        }
        $bill->remarks = $input['remarks'];
        $bill->operator_id = Auth::user()->id;
        $bill->amount_tendered = $input['amount_tendered'];
        $bill->paid_date = $input['paid_date'];
        $bill->is_paid = CompanyBill::IS_PAID_YES;
        $bill->is_invoice = $input['is_invoice'] == CompanyBill::IS_INVOICE_YES ? CompanyBill::IS_INVOICE_YES : CompanyBill::IS_INVOICE_NO;
        $bill->save();
        Session::flash('success', '收款成功');
        return redirect(action('CompanyBillController@getAllBills', $companyId));
    }


    /**
     * @param Request $request
     * @param $companyId
     * @param $id
     * @return $this
     */
    public function doInvoice(Request $request, $companyId, $id)
    {
        $map = [
            'user_id' => Session::get('company_id'),
            'company_id' => $companyId,
            'id' => $id
        ];

        try {
            $bill = CompanyBill::where($map)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            Session::flash('error', '收款项不存在,非法操作');
            return redirect()->back()->withInput($request->all());
        }

        $bill->is_invoice = CompanyBill::IS_INVOICE_YES;
        $bill->save();
        Session::flash('success', '开票成功');
        return redirect()->back()->withInput($request->all());
    }

    /**
     * 更新收款项
     * @param Request $request
     * @param $companyId
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateBill(Request $request, $companyId, $id)
    {
        $input = $request->only('item', 'grand_total', 'deadline', 'remarks');

        $rules = [
            'item' => 'required',
            'grand_total' => 'required|numeric|min:1',
            'deadline' => 'required|date'
        ];

        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            Session::flash('error', $v->messages()->first());
            return redirect()->back()->with($input);
        }
        $map = [
            'user_id' => Session::get('company_id'),
            'company_id' => $companyId,
            'id' => $id
        ];
        try {
            $bill = CompanyBill::where($map)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            Session::flash('error', '收款项不存在,非法操作');
            return redirect()->back()->withInput($input);
        }

        if ($bill->is_paid == CompanyBill::IS_PAID_YES) {
            Session::flash('error', '已收款，不可编辑');
            return redirect()->back()->withInput($input);
        }
        $bill->item = $input['item'];
        $bill->remarks = $input['remarks'];
        $bill->operator_id = Auth::user()->id;
        $bill->grand_total = $input['grand_total'];
        $bill->deadline = $input['deadline'];
        $bill->save();
        Session::flash('success', '修改收款项成功');
        return redirect(action('CompanyBillController@getAllBills', $companyId));
    }

    /**
     * 删除收款项
     * @param Request $request
     * @param $companyId
     * @param mixed $id
     * @return mixed
     * @author Minco <root@lostman.org>
     */
    public function deleteBill(Request $request, $companyId, $id)
    {
        $map = [
            'user_id' => Session::get('company_id'),
            'company_id' => $companyId,
            'id' => $id
        ];


        try {
            $bill = CompanyBill::where($map)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            Session::flash('error', '收款项不存在,非法操作');
            return redirect()->back()->withInput($request->all());
        }

        $bill->delete();
        Session::flash('success', '删除收款项成功');
        return redirect()->back()->withInput($request->all());
    }


    /**
     * @param $companyId
     * @return \Illuminate\View\View
     */
    public function toAddCycleBill($companyId)
    {
        return view('customer.bill.create-cycle');
    }


    /**
     * 增加收款周期
     * @param Request $request
     * @param $companyId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addCycleBill(Request $request, $companyId)
    {

        $input = $request->only('item', 'grand_total', 'start_date', 'rule', 'remarks');

        $rules = [
            'item' => 'required',
            'grand_total' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'rule' => 'required|in:1m,3m,12m'//每1个月，每3个月，每年
        ];

        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            Session::flash('error', $v->messages()->first());
            return redirect()->back()->with($input);
        }

        $arr = explode("-", $input['start_date']);
        $startDate = Carbon::createFromDate($arr[0], $arr[1], $arr[2]);
        $bill = new CompanyCycleBill();
        $bill->item = $input['item'];
        $bill->user_id = Session::get('company_id');
        $bill->company_id = $companyId;
        $bill->operator_id = Auth::user()->id;
        $bill->grand_total = $input['grand_total'];
        $bill->start_date = $input['start_date'];
        $bill->next_date = $startDate->addMonth(intval($input['rule']));
        $bill->rule = $input['rule'];
        $bill->remarks = $input['remarks'];

        $bill->save();

        $now = Carbon::now();
        if ($now->format('Y-m-d') == $bill->start_date) {
            $companyBill = new CompanyBill();
            $item = $bill->item;
            if ($bill->rule = '1m') {
                $item = $item . "(" . $now->month . "月)";
            } elseif ($bill->rule = '3m') {
                $item = $item . "(" . (int)($now->month / 4 + 1) . "季度)";
            } elseif ($bill->rule = '12m') {
                $item = $item . "(" . $now->year . "年)";
            }

            $companyBill->item = $item;
            $companyBill->user_id = $bill->user_id;
            $companyBill->remarks = $bill->remarks;
            $companyBill->company_id = $bill->company_id;
            $companyBill->operator_id = $bill->operator_id;
            $companyBill->grand_total = $bill->grand_total;
            $companyBill->deadline = $bill->start_date;
            $companyBill->cycle_bill_id = $bill->id;
            $companyBill->save();
        }

        Session::flash('success', '添加收款周期成功');
        return redirect(action('CompanyBillController@getAllBills', $companyId)."?type=cycle");
    }


    /**
     * 去编辑收款周期页面
     * @param Request $request
     * @param $id
     * @return $this
     */
    public function toUpdateCycleBill(Request $request, $companyId, $id)
    {
        $map = [
            'user_id' => Session::get('company_id'),
            'company_id' => $companyId,
            'id' => $id
        ];
        try {
            $cycleBill = CompanyCycleBill::where($map)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            Session::flash('error', '收款周期不存在,非法操作');
            return redirect()->back()->withInput($request->all());
        }
        return view('customer.bill.update-cycle')->with('cycleBill', $cycleBill);
    }

    /**
     * 更新收款周期
     * @param Request $request
     * @param $companyId
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateCycleBill(Request $request, $companyId, $id)
    {
        $input = $request->only('item', 'grand_total', 'start_date', 'rule', 'remarks');

        $rules = [
            'item' => 'required',
            'grand_total' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'rule' => 'required|in:1m,3m,12m'//每1个月，每3个月，每年
        ];

        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            Session::flash('error', $v->messages()->first());
            return redirect()->back()->with($input);
        }
        $map = [
            'user_id' => Session::get('company_id'),
            'company_id' => $companyId,
            'id' => $id
        ];
        try {
            $bill = CompanyCycleBill::where($map)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            Session::flash('error', '收款周期不存在,非法操作');
            return redirect()->back()->withInput($input);
        }

        $bill->item = $input['item'];
        $bill->operator_id = Auth::user()->id;
        $bill->grand_total = $input['grand_total'];
        $bill->start_date = $input['start_date'];
        $bill->rule = $input['rule'];
        $bill->remarks = $input['remarks'];
        $bill->save();
        Session::flash('success', '修改收款周期成功');
        return redirect(action('CompanyBillController@getAllBills', $companyId)."?type=cycle");
    }


    public function deleteCycleBill(Request $request, $companyId, $id)
    {

        $map = [
            'user_id' => (int)(Session::get('company_id')),
            'company_id' => (int)($companyId),
            'id' => (int)($id)
        ];
        try {
            $cycleBill = CompanyCycleBill::where($map)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            Session::flash('error', '任务不存在,非法操作');
            return redirect()->back()->withInput($request->all());
        }
        $cycleBill->delete();
        CompanyBill::where('cycle_bill_id', $id)
            ->where('is_paid', CompanyBill::IS_PAID_NO)
            ->where('deadline', '>', Carbon::now())
            ->delete();
        Session::flash('success', '删除收款项成功');
        return redirect()->back()->withInput($request->all());
    }

}
