<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompanyBankAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('company_bank_account', function(Blueprint $table){
            $table->string('register_user_name')->comment('开户人姓名')->nullable();
            $table->string('register_user_mobile', 11)->comment('开户人手机')->nullable();
            $table->string('province')->nullable()->comment('开户省');
            $table->string('city')->nullable()->comment('开户市');
            $table->string('bank_url')->comment('银行网址')->nullable();
            $table->string('bank_address')->comment('银行地址')->nullable();
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
        Schema::table('company_bank_account', function(Blueprint $table){
            $table->dropColumn('register_user_name');
            $table->dropColumn('register_user_mobile');
            $table->dropColumn('province');
            $table->dropColumn('city');
            $table->dropColumn('bank_url');
            $table->dropColumn('bank_address');

        });
    }
}
