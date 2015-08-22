<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('registion_type')->comment('注册类型');
            $table->string('name')->comment('代帐公司名称');
            $table->integer('package_id')->nullable()->comment('产品套餐ID,收费用');
            $table->timestamp('rate_start')->nullable()->comment('计费开始时间');
            $table->timestamp('rate_end')->nullable()->comment('计费过期时间');
            $table->tinyInteger('status')->defalut(0)->comment('账户状态0正常1异常');
            $table->string('mobile', 11)->comment('手机号码');
            $table->integer('main_user');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
