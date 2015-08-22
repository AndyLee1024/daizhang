<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyBankAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('company_bank_account', function(Blueprint $t){
            $t->increments('id');
            $t->integer('company_id');
            $t->integer('operator_id');
            $t->string('account_type')->comment('卡的类别');
            $t->string('account')->comment('卡号');
            $t->string('account_name')->comment('开户名');
            $t->string('bank')->comment('银行名称');
            $t->string('bank_branch')->nullable()->comment('支行名称');
            $t->text('remarks')->nullable();
            $t->timestamps();
            $t->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('company_bank_account');
    }
}
