<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNexusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_nexus', function(Blueprint $table){

            $table->increments('id');
            $table->integer('operator_id')->comment('操作员ID');
            $table->integer('user_id')->comment('代帐公司ID');
            $table->integer('level')->comment('等级设定');
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
        Schema::drop('user_nexus');
    }
}
