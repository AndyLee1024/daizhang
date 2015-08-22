<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateUserOperatorsTableAddWxUserIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_operators', function (Blueprint $table) {
            $table->integer('wx_user_id')->unsigned()->comment('微信用户表ID')->after('mobile');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_operators', function (Blueprint $table) {
            $table->dropColumn('wx_user_id');
        });
    }
}
