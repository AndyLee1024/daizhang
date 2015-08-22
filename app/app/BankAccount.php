<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 银行账户模块
 * @package App
 * @version 1.0
 * @author  AndyLee <root@lostman.org>
 */
class BankAccount extends Model
{
    //
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'company_bank_account';
}
