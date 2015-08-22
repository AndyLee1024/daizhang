<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompanyBankTable extends Migration
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

            $table->dropColumn('register_user_name');
            $table->dropColumn('register_user_mobile');

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
            $table->string('register_user_name');
            $table->string('register_user_mobile');
        });
    }
}
