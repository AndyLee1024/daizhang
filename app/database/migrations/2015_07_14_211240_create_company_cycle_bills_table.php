<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCompanyCycleBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_cycle_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->comment('公司ID');
            $table->integer('user_id')->unsigned()->comment('所属代帐公司ID');
            $table->integer('operator_id')->unsigned()->comment('操作人员ID');
            $table->string('item')->nullable()->comment('收费项目');
            $table->decimal('grand_total')->nullable()->comment('应付总额');
            $table->string('rule')->comment('收费周期规则');
            $table->timestamp('start_date')->nullable()->comment('周期开始时间');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('company_cycle_bills');
    }
}
