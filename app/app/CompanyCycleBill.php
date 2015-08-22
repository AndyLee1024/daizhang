<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 公司周期账单
 * @property mixed rule
 * @package App
 * @version 1.0
 * @author  Minco <minco.wang@gmail.com>
 */
class CompanyCycleBill extends Model
{
    //
    protected $table = 'company_cycle_bills';

    /**
     * 获取款项周期描述
     * @return string
     */
    public function getRuleDescription()
    {
        if ('1m' == $this->rule) {
            return "每月";
        }
        if ('3m' == $this->rule) {
            return "每季度";
        }
        if ('12m' == $this->rule) {
            return "每年";
        }
        return "";
    }
    public function getDates()
    {
        return array_merge(parent::getDates(),['start_date','next_date']);
    }
}
