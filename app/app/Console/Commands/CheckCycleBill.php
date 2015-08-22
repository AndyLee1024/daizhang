<?php

namespace App\Console\Commands;

use App\CompanyBill;
use App\CompanyCycleBill;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckCycleBill extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-cycle-bill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check cycle bill and create the company bill.';

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
        Log::info('Begin the check-cycle-bill command.');
        $now = Carbon::now();
        $cycleBillList = CompanyCycleBill::where('next_date', '>=', $now->format('Y-m-01 00:00:00'))->where('next_date', '<=', $now->format('Y-m-31 23:59:59'))->get();
        foreach ($cycleBillList as $cycleBill) {

            $companyBill = new CompanyBill();
            $item = $cycleBill->item;
            if ($cycleBill->rule = '1m') {
                $item = $item . "(" . $now->month . "月)";
            } elseif ($cycleBill->rule = '3m') {
                $item = $item . "(" . (int)($now->month / 4 + 1) . "季度)";
            } elseif ($cycleBill->rule = '12m') {
                $item = $item . "(" . $now->year . "年)";
            }

            $companyBill->item = $item;
            $companyBill->user_id = $cycleBill->user_id;
            $companyBill->remarks = $cycleBill->remarks;
            $companyBill->company_id = $cycleBill->company_id;
            $companyBill->operator_id = $cycleBill->operator_id;
            $companyBill->grand_total = $cycleBill->grand_total;
            $companyBill->deadline = $cycleBill->next_date;
            $companyBill->cycle_bill_id = $cycleBill->id;
            $companyBill->save();
            $cycleBill->next_date = $cycleBill->next_date->addMonth(intval($cycleBill->rule));
            $cycleBill->save();
        }
        Log::info('End the check-cycle-bill command.');
    }
}
