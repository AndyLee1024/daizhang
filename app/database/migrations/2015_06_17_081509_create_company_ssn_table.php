<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanySsnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('company_ssn', function(Blueprint $table){
            $table->increments('id');
            $table->integer('company_id');
            $table->integer('operator_id');
            $table->string('ssn_account')->comment('社会保险账户');
            $table->string('ssn_id')->comment('社会保险编号');
            $table->string('ssn_fmc')->nullable()->comment('社保管理中心名称');
            $table->string('ssn_fmc_tel')->nullable()->comment('社保管理中心电话');
            $table->string('ssn_fmc_address')->nullable()->comment('社保管理中心地址');
            $table->string('report_type')->comment('申报方式');
            $table->integer('uses')->comment('申报人数');
            $table->text('remarks')->nullable()->comment('备注');
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
        Schema::drop('company_ssn');
    }
}
