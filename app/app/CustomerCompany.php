<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property mixed id
 */
class CustomerCompany extends Model
{
    //
    protected $table = 'companies';

    public function  getDefaultContact()
    {
        return Contact::where('company_id', $this->id)->where('is_default', 1)->first();
    }

    public function getTaxStatus(){
        return $this->hasMany('Tax', 'company_id', 'id');
    }


    /**
     * 获得当前客户对于当前代账公司的待付款总额
     * @param $userId
     * @return mixed
     */
    public function sumAllUnpaidBill($userId){
        return CompanyBill::where('user_id', $userId)
            ->where('is_paid', CompanyBill::IS_PAID_NO)
            ->where('company_id', $this->id)
            ->sum('grand_total');
    }

    /**
     * 获得当前客户对于当前代账公司的待付款项目数
     * @param $userId
     * @return mixed
     */
    public function countUnpaidBill($userId){
        return CompanyBill::where('user_id', $userId)
            ->where('is_paid', CompanyBill::IS_PAID_NO)
            ->where('company_id', $this->id)
            ->count();
    }

}


