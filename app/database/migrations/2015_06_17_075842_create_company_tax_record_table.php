<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTaxRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('company_tax_record', function(Blueprint $table){

            $table->increments('id');
            $table->integer('user_id')->comment('代帐公司ID');
            $table->integer('company_id');
            $table->integer('operator_id');
            $table->string('file_path')->nullable()->comment('附件路径');
            $table->timestamp('finish_time')->nullable()->comment();
            $table->string('uuid')->comment('每月标识');
            $table->tinyInteger('guoshui_status')->default(0)->comment('国税报税状态0未完成1完成');
            $table->tinyInteger('dishui_status')->default(0)->comment('地税报税状态0未完成1完成');
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
        Schema::drop('company_tax_record');
    }
}
