<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserKvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_kv', function(Blueprint $table){

            $table->increments('id');
            $table->integer('operator_id')->comment('操作员ID');
            $table->integer('user_id')->comment('代帐公司ID');
            $table->string('key')->comment('Key');
            $table->text('value')->comment('Value');
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
        Schema::drop('user_kv');
    }
}
