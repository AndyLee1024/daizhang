<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWxUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 微信用户表
        Schema::create('wx_users', function(Blueprint $table){
            $table->increments('id');
            $table->smallInteger('subscribe')->default(0)->comment("是否关注：0否，1是");
            $table->string('openid')->comment("微信用户标识");
            $table->string('nickname')->comment("微信用户昵称");
            $table->smallInteger('sex')->default(0)->comment("性别，1男性，2女性，0未知");
            $table->string('city')->nullable()->comment("用户所在城市");
            $table->string('country')->nullable()->comment("用户所在国家");
            $table->string('province')->nullable()->comment("用户所在省份");
            $table->string('language')->nullable()->comment("用户的语言，简体中文为zh_CN");
            $table->string('headimgurl')->nullable()->comment("用户头像");
            $table->integer('subscribe_time')->nullable()->comment("用户关注时间，为时间戳");
            $table->string('unionid')->nullable()->comment("只有在用户将公众号绑定到开放平台账号后才会有该字段");
            $table->string('remark')->nullable()->comment("公众号运营者对粉丝的备注");
            $table->integer('groupid')->nullable()->comment("用户所在分组的ID");
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
        Schema::drop('wx_users');
    }
}
