<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('company_accounts', function(Blueprint $table){

            $table->increments('id');
            $table->integer('company_id');
            $table->string('login_name')->comment('站点名称');
            $table->string('password')->comment('站点密码');
            $table->string('site_url')->nullable()->comment('站点地址');
            $table->integer('operator_id');
            $table->text('remarks')->nullable();
            $table->string('account_type')->nullable()->comment('账户类型');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::drop('company_accounts');
    }
}
