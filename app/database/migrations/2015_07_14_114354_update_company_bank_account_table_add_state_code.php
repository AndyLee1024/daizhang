<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompanyBankAccountTableAddStateCode extends Migration
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
            $table->integer('state_code')->comment('地区代码');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_bank_account', function(Blueprint $table){
            $table->dropColumn('state_code');
        });
    }
}
