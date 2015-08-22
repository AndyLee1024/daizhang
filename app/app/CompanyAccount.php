<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * 公司账户密码管理
 * @package App
 * @version 1.0
 * @author  AndyLee <root@lostman.org>
 */
class CompanyAccount extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'company_accounts';
}
