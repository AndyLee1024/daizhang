<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompanyBankAccountAddTown extends Migration
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
            $table->string('town')->comment('区或镇');
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
            $table->dropColumn('town');
        });
    }
}
