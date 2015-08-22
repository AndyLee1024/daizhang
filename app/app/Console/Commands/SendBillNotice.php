<?php

namespace App\Console\Commands;

use App\Company;
use App\CompanyBill;
use App\CustomerCompany;
use App\Library\Sms;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SendBillNotice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-bill-notice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('Begin the send-bill-notice command.');
        $now = Carbon::now();
        $beforeDay = \Config::get('app.day_before_send_bill_notice');
        $billList = CompanyBill::where('deadline', '=', $now->addDay($beforeDay)->format('Y-m-d 00:00:00'))->where('is_paid', CompanyBill::IS_PAID_NO)->select('company_id','user_id')->distinct()->get();
        foreach ($billList as $bill) {
            $map = [
                'user_id' => $bill->user_id,
                'id' => $bill->company_id
            ];

            $customerCompany = CustomerCompany::where($map)->first();
            if (!$customerCompany) {
                Log::error('send-bill-notice:Not find company.');
                continue;
            }
            $contact = $customerCompany->getDefaultContact();
            if (!$contact) {
                Log::error('send-bill-notice:Not find company contact.');
                continue;
            }

            $company = Company::where('id', $bill->user_id)->first();
            if (!$company) {
                Log::error('send-bill-notice:Not find daizhang user.');
                continue;
            }

            $sql = "SELECT sum(cb.grand_total) as grand_total, count(cb.id) as total_item FROM company_bills cb  where cb.is_paid=0 and cb.user_id=$bill->user_id and cb.company_id=$bill->company_id";
            $unpaidResult = DB::select($sql);
            if(count($unpaidResult)==0){
                continue;
            }
            $totalItem = $unpaidResult[0]->total_item;
            $grandTotal = $unpaidResult[0]->grand_total;

            $sms = new Sms();
            $text = "【代账通】尊敬的客户，贵公司尚有未支付费用 $totalItem 项，共计 ¥$grandTotal 元 。请及时联系 $company->name 缴纳。";
            $result = $sms->sendMessage($text, $contact->mobile);
            if ($result->code != 0) {
                Log::error('send-bill-notice:Send SMS error.' . $result->detail);
                continue;
            }
        }
        Log::info('End the send-bill-notice command.');
    }
}
