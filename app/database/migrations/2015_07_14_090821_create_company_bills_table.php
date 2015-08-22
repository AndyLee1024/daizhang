<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCompanyBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->comment('公司ID');
            $table->integer('user_id')->unsigned()->comment('所属代帐公司ID');
            $table->integer('operator_id')->unsigned()->comment('操作人员ID');
            $table->string('item')->nullable()->comment('收费项目');
            $table->decimal('grand_total')->default(0)->comment('应付总额');
            $table->decimal('amount_tendered')->default(0)->comment('实付总额');
            $table->integer('cycle_bill_id')->unsigned()->comment('周期账单ID');
            $table->timestamp('deadline')->nullable()->comment('付款截止时间');
            $table->timestamp('paid_date')->nullable()->comment('实际付款时间');
            $table->tinyInteger('is_invoice')->default(0)->comment('是否开票,0:否,1:是');
            $table->tinyInteger('is_paid')->default(0)->comment('是否支付,0:否,1:是');
            $table->text('remarks')->nullable();
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
        Schema::drop('company_bills');
    }
}
