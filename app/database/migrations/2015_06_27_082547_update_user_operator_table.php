<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserOperatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('user_operators', function(Blueprint $table){

            $table->string('remember_token')->nullable();
            $table->string('avatar')->comment('头像地址');

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
        //
        Schema::table('user_operators', function(Blueprint $table){

            $table->dropColumn('remember_token');
            $table->dropColumn('avatar');
        });
    }
}
