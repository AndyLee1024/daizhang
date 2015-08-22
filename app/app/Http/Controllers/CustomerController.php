<?php

namespace App\Http\Controllers;

use App;
use Auth;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Input;
use Session;
use Config;
use Redirect;
use Validator;
use App\Contact;
use App\Partner;
use Ramsey\Uuid\Uuid;
use App\Http\Requests;
use App\Certificate;
use Overtrue\Pinyin\Pinyin;
use App\Library\Requests as R;
use App\CustomerCompany as Company;

/**
 * 客户模块
 * @package App\Http\Controllers
 * @version 1.0
 * @author  AndyLee <root@lostman.org>
 */
class CustomerController extends BaseController
{
    /**
     * 列出客户
     * @param Request $request
     * @return $this
     * @author AndyLee <root@lostman.org>
     */
    public function getIndex(Request $request)
    {

        $map = [
            'user_id' => Session::get('company_id')
        ];

        $companies = Company::where($map)->get();

        return view('customer.index.list')->with('companies', $companies);
    }

    /**
     * 客户首字母排序
     * @author AndyLee <root@lostman.org>
     */
    public function getOrderCustomer($alpha)
    {


        $map = [
            'user_id' => Session::get('company_id'),
            'order' => $alpha
        ];

        $companies = Company::where($map)->get();

        return view('customer.index.list')->with('companies', $companies);

    }

    /**
     * 创建客户页面
     * @author AndyLee <root@lostman.org>
     */
    public function getCreate()
    {
        /**
         * 判断工商局状态
         */
        $input = Input::Only('mode');
        if ($input['mode'] === 'off') {
            return view('customer.index.create')->with('mode', 'off');
        } else {
            $url = "http://www.jsgsj.gov.cn:58888/province/";
            $requests = new R();
            $cookie = $requests->getRequestCookie($url);

            /**
             * 工商局系统出错
             */
            if (empty($cookie)) {
                return view('customer.index.create')->with('mode', 'off');
            }

            /**
             * 下载验证码图片
             */

            $verify_url = "http://www.jsgsj.gov.cn:58888/province/rand_img.jsp?type=7";

            Cache::forget(Auth::user()->id . '_session');

            Cache::put(Auth::user()->id . '_session', $cookie, 10);


            $image = 'captcha/' . sha1(Auth::user()->id);

            $requests->saveImage($verify_url, $image . '.png', $cookie);

            return view('customer.index.create');
        }


    }



    /**
     * 创建客户(入库)
     * @author AndyLee <root@lostman.org>
     */
    public function postCompanyDetail()
    {
        /**
         * full_name 公司全称
         * name 公司简称
         * leader 法人
         * registion_type 注册类型
         * address 详细地址
         * registed_funds 注册资本
         * register_time 经营期限开始
         * end_time 经营期限结束
         * register_number 工商注册号
         * registed_funds_type 注册资本类型
         * scope 经营范围
         * bookkeeper 财务负责人 一般取当前操作员
         * contact 联系人
         * mobile 手机
         * partners 股东信息
         */
        $input = Input::Only('full_name', 'name', 'registion_type', 'address',
            'registed_funds', 'register_time', 'end_time', 'register_number', 'scope', 'import_partners',
            'bookkeeper', 'contact', 'mobile', 'partners', 'registed_funds_type', 'leader');

        $rules = [
            'full_name' => 'required',
            'name' => 'required',
            'registion_type' => 'required',
            'address' => 'required',
            'registed_funds' => 'required',
            'register_time' => 'date',
            'end_time'      => 'date'
        ];

        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            Session::flash('error', $v->messages()->first());
            return Redirect::to(action('CustomerController@getCreate'));
        }

        /**
         * 处理注册资本
         * 如"2000.818万美元"; 将返回2000 818
         */
        preg_match_all("/[x80-xff]+/", $input['registed_funds'], $match);
        $uuid = Uuid::uuid1();

        $company = new Company();
        $company->full_name = trim($input['full_name']);
        $company->user_id = Session::get('company_id');
        $company->uuid = $uuid->toString();
        $company->bookkeeper = Auth::user()->id;
        $company->name = trim($input['name']);
        $company->location = trim($input['address']);
        $company->registion_type = $input['registion_type'];
        $company->create_time = time();

        /**
         * 处理公司简称首字母
         */

        $first_word = mb_substr($input['name'], 0, 1, 'utf-8');

        $pinyin = App::make('pinyin');

        $order = $pinyin->letter($first_word);

        $company->order = $order;

        if (isset($match[0][1])) {
            $company->registed_funds = $match[0][0] . '.' . $match[0][1];
        } else {
            $company->registed_funds = $match[0][0];
        }
        if (!empty($input['register_time'])) {
            $company->register_time = strtotime($input['register_time']);
        }
        if (!empty($input['end_time'])) {
            $company->end_time = strtotime($input['end_time']);
        }
        if (!empty($input['register_number'])) {
            $company->register_number = $input['register_number'];
        }
        if (!empty($input['scope'])) {
            $company->scope = $input['scope'];
        }
        if (!empty($input['leader'])) {
            $company->leader = $input['leader'];
        }
        if (!empty($input['registed_funds_type'])) {
            $company->funds_type = $input['registed_funds_type'];
        } else {
            $company->funds_type = "人民币";
        }

        $company->operator_id = Auth::user()->id;
        $company->save();

        /**
         * 如果存在联系人就加入公司联系人列表
         */
        if (!empty($input['contact']) and !empty($input['mobile'])) {
            $contact = new Contact();
            $contact->company_id = $company->id;
            $contact->operator_id = Auth::user()->id;
            $contact->name = trim($input['contact']);
            $contact->mobile = trim($input['mobile']);
            $contact->is_default = 1;
            $contact->save();
        }

        /**
         * 如果股东信息存在就加入公司股东表
         */
        if (!empty($input['partners']) and $input['import_partners'] == 1) {
            $partners = unserialize($input['partners']);

            /**
             * 循环获取股东
             */
            foreach ($partners as $k) {

                $partner = new Partner();
                $partner->company_id = $company->id;
                $partner->operator_id = Auth::user()->id;
                $partner->partner_type = $k['C1'] ? $k['C1'] : '境内中国公民';
                $partner->name = $k['C2'];
                $partner->certificate = $k['C3'];
                $partner->certificate_number = $k['C4'] ? $k['C4'] : '';
                if ($k['RN'] === 1) {
                    $post = '董事长';
                } else {
                    $post = '董事';
                }
                $partner->post = $post;
                $partner->save();

            }
        }

        /**
         * 初始化证照信息
         */

        $certs = Config::get('customer.certificate');

        foreach($certs as $k => $v){
            foreach($v as $m){

                $certificate = new Certificate();
                $certificate->company_id = $company->id;
                $certificate->operator_id = Auth::user()->id;
                $certificate->certificate_type = $k;
                $certificate->certificate_number = '';
                $certificate->certificate_path = '';
//                $certificate->remarks = $m;
                $certificate->name = $m;
                $certificate->save();

            }
        }



        Session::flash('success', '创建客户公司完成');

        return Redirect::to(action('CustomerController@getIndex'));

    }

    /**
     * 手工录入
     * @author AndyLee <root@lostman.org>
     */
    public function getWrite()
    {
        return view('customer.index.write');
    }


    /**
     * 从工商获取公司详细信息
     * @author AndyLee <root@lostman.org>
     */
    public function getCompanyDetail()
    {
        $input = Input::Only("org", "id", "seq_id", "name");
        //TODO 数据验证

        $url = 'http://www.jsgsj.gov.cn:58888/ecipplatform/fieiServlet.json?fieiQYJBXX=true';
        $cookie = Cache::get(Auth::user()->id . '_session');

        $input['specificQuery'] = 'basicInfo';
        $requests = new R();
        $result = $requests->postRequest($url, $input, $cookie);

        /**
         * 获取合伙人信息
         */
        $params = [
            "CORP_ORG" => $input["org"],
            "CORP_ID" => $input["id"],
            "CORP_SEQ_ID" => $input["seq_id"],
            "specificQuery" => "investmentInfor",
            "showRecordLine" => 1,
            "pageNo" => 1,
            "pageSize" => 5
        ];

        $url = "http://www.jsgsj.gov.cn:58888/ecipplatform/ciServlet.json?ciEnter=true";

        $mates = $requests->postRequest($url, $params, $cookie);

        $result_array = json_decode($result, true);
        $mates_array = json_decode($mates, true);
        $result_array['company_name'] = $input['name'];

        $req = array_merge($result_array, $mates_array);

        return view('customer.index.auto_write')->with('req', $req);

    }

    /**
     * 处理录入公司操作
     * @author AndyLee <root@lostman.org>
     */
    public function postMainProcess()
    {
        $input = Input::Only('company_name', 'name', 'mode', 'new_company', 'captcha');

        $rules = [

            'company_name' => 'required',
            'name' => 'required',

        ];

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());

            return redirect(action('CustomerController@getCreate'));
        }

        /**
         * 手动录入
         */
        if ($input['mode'] == 'off') {
            /**
             * 直接跳到手动录入
             */
            if ($input['new_company'] == 1) {
                $input['company_name'] = $input['company_name'] . '(筹)';
            }
            return view('customer.index.write')->with('input', $input);
        } else {
            /**
             * 开始查询公司信息
             */

            $info['name'] = $input['company_name'];
            $info['verifyCode'] = $input['captcha'];


            $cookie = Cache::get(Auth::user()->id . '_session');


            $url = "http://www.jsgsj.gov.cn:58888/province/infoQueryServlet.json?queryCinfo=true";

            $requests = new R();

            $req = $requests->postRequest($url, $info, $cookie);

            /**
             * 重新加工一下代码
             */
            $company_list = json_decode($req, true);

            $result = [];

            /**
             * 判断服务器返回状态
             */
            if ($company_list[0]['COUNT'] === '>> 您查询的信息多于5条记录，请输入更精确的查询条件 <<') {
                $message = "您查询的信息多于5条记录，请输入更精确的查询条件";
                return view('customer.index.alert')->with('message', $message);
            } elseif ($company_list[0]['TIPS'] === '验证码填写错误，请重新填写！') {
                $message = "验证码填写错误，请重新填写！";
                return view('customer.index.alert')->with('message', $message);
            } else {
                $result['message_code'] = 1;
                $result['message'] = '拉取数据成功';
                $result['body'] = $company_list[0];
                return view('customer.index.company_list')->with('result', $result)->with('input', $input);
            }

        }
    }

    /**
     * 设置客户公司
     * Session company_id 为代帐公司ID
     * Session customer_id 为客户ID
     * @param string uuid 公司的唯一识别码
     * @author AndyLee <root@lostman.org>
     */
    public function getSetCustomerCompany($uuid)
    {

        $map = [
            'uuid' => $uuid,
            'user_id' => Session::get('company_id')
        ];

        try {
            $company = Company::where($map)->firstOrFail();
        } catch (\ModelNotFoundException $e) {
            Session::flash('error', '您访问的公司不存在!');
            return Redirect::to(action('CustomerController@getIndex'));
        }

        Session::forget('customer_id');
        Session::put('customer_id', $company->id);

        Session::flash('success', '设置客户公司成功');
        return Redirect::to(action('CustomerController@getCustomerCompanyInfo', Session::get('customer_id')));

    }

    /**
     * 列出客户公司信息
     * @param integer $id
     * @return mixed
     * @author AndyLee <root@lostman.org>
     */
    public function getCustomerCompanyInfo($id)
    {

//       dd( action('PartnerController@getPartner' , 12));

        $contact = Contact::where([
            'company_id' => Session::get('customer_id'),
            'is_default' => 1
        ])->first();

        $type = Config::get('customer.certificate');

        $result = [];

        /**
         * 查询不同的证件上传情况
         */
        foreach($type as $k => $v){

            $record = Certificate::where([
                'company_id'       => Session::get('customer_id'),
                'certificate_type' => $k
            ])->first();

            if($record){
                $result[$k] = 'exist';
            }else{
                $result[$k] = 'empty';
            }
        }

        /**
         * 获取代办事项
         */
        $todo = App\Task::where([
            'company_id' => Session::get('customer_id'),
            'is_finish'  => 0
        ])->take(10)->get();

        $company = Company::find(Session::get('customer_id'));
        return view('customer.index.detail')->with('contact', $contact)
            ->with('result', $result)
            ->with('todo', $todo)
            ->with('company', $company);
    }

    /**
     * 修改公司信息
     * @param integer $id
     * @return mixed
     * @author AndyLee <root@lostman.org>
     */
    public function getModifyCompany($id)
    {
        $company = Company::where([
            'id'    => $id,
            'user_id' => Session::get('company_id')
        ])->first();

        if(empty($company)){
            Session::flash('error', '公司不存在,无法编辑');
            return redirect()->back();
        }

        return view('customer.index.modify_company')->with('company', $company);
    }

    /**
     * 修改公司信息操作
     * @param Request $request
     * @return mixed
     * @param integer $id
     * @author AndyLee <root@lostman.org>
     */
    public function postModifyCompany(Request $request, $id){
        $company = Company::where([
            'id'    => $id,
            'user_id' => Session::get('company_id')
        ])->first();

        if(empty($company)){
            Session::flash('error', '公司不存在,无法编辑');
            return redirect()->back();
        }

        $input = $request->only('full_name', 'name', 'leader', 'address', 'registion_type',
            'registed_funds', 'registed_funds_type', 'register_time', 'end_time', 'register_number', 'scope');

        $rules = [
            'full_name' => 'required',
            'name' => 'required',
            'registion_type' => 'required',
            'address' => 'required',
            'registed_funds' => 'required',
            'register_time' => 'date',
            'end_time'      => 'date'
        ];

        $v = Validator::make($input, $rules);
        if($v->fails()){
            Session::flush('error', $v->messages()->first());
            return redirect()->back();
        }

        $company->full_name = $input['full_name'];
        $company->name = $input['name'];
        $company->leader = $input['leader'];
        $company->location = $input['address'];
        $company->registion_type = $input['registion_type'];
        $company->registed_funds = $input['registed_funds'];
        $company->funds_type = $input['registed_funds_type'];
        if(!empty($input['register_time'])){
            $company->register_time = strtotime($input['register_time']);
        }
        if(!empty($input['end_time'])){
            $company->end_time = strtotime($input['end_time']);
        }
        $company->register_number = $input['register_number'];
        $company->scope = $input['scope'];
        $company->save();

        Session::flash('success', '更新公司信息成功');

        return redirect()->to(action('CustomerController@getCustomerCompanyInfo', Session::get('customer_id')));

    }


}
