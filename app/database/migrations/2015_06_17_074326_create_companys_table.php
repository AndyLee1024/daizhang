<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('companys', function(Blueprint $table){

            $table->increments('id');
            $table->integer('user_id')->comment('所属代帐公司ID');
            $table->string('full_name')->comment('公司全称');
            $table->string('name')->comment('公司简称');
            $table->string('location')->comment('公司详细地址');
            $table->string('registed_funds', 12)->comment('注册资金');
            $table->string('corporate')->nullable()->comment('公司法人');
            $table->integer('bookkeeper')->nullable()->comment('财务负责人，与联系人关联');
            $table->timestamp('register_time')->nullable()->comment('公司注册时间');
            $table->timestamp('end_time')->nullable()->comment('公司失效时间');
            $table->string('funds_type', 4)->nullable()->comment('注册资本单位');
            $table->integer('operator_id');
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
        Schema::drop('companys');
    }
}
