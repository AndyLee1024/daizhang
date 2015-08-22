<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTodoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('company_todo', function(Blueprint $table){

            $table->increments('id');
            $table->integer('user_id')->comment('所属代帐公司ID');
            $table->string('todo_name')->comment('代办事项');
            $table->text('remarks')->nullable()->comment('备注');
            $table->tinyInteger('is_finish')->default(0)->comment('是否完成0否1是');
            $table->integer('company_id');
            $table->integer('operator_id');
            $table->timestamp('remind_time')->comment('提醒时间');
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
        Schema::drop('company_todo');
    }
}
