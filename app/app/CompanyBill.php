<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * 公司账单
 * @package App
 * @version 1.0
 * @author  Minco <minco.wang@gmail.com>
 */
class CompanyBill extends Model
{
    //
    protected $table = 'company_bills';

    const IS_INVOICE_YES = 1;
    const IS_INVOICE_NO = 0;

    const IS_PAID_YES = 1;
    const IS_PAID_NO = 0;

    public function getDates()
    {
        return array_merge(parent::getDates(), ['deadline', 'paid_date']);
    }

    /**
     * 获得有待收款项公司个数
     * @param $userId
     * @return int
     */
    public static function countUnpaidCompany($userId)
    {
        return count(self::where('is_paid', self::IS_PAID_NO)->where('user_id', $userId)->distinct()->lists('company_id'));
    }

    /**
     * 获得公司待收款个数
     * @param $userId
     * @param $companyId
     * @return int
     */
    public static function countUnpaid($userId, $companyId)
    {
        return self::where('is_paid', self::IS_PAID_NO)->where('company_id', $companyId)->where('user_id', $userId)->count();
    }


    /**
     * 统计代账公司所有都待收款总额
     * @param $userId
     * @return mixed
     */
    public static function sumAllUnpaidByUser($userId)
    {
        return self::where('is_paid', self::IS_PAID_NO)->where('user_id', $userId)->sum('grand_total');
    }

    /**
     * 统计代账公司本月已收总额
     * @param $userId
     * @return mixed
     */
    public static function sumCurrentMonthPaidByUser($userId)
    {
        $now = Carbon::now();
        return self::where('user_id', $userId)->where('deadline', '>=', $now->format('Y-m-1 00:00:00'))->where('deadline', '<=', $now->format('Y-m-31 23:59:59'))->sum('grand_total');
    }
}
