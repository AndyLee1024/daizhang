<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompanyTodoTableAddFinishTimeColomn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('company_todo', function(Blueprint $table){
            $table->bigInteger('finish_time')->nullable()->comment('完成时间 时间戳');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_todo', function(Blueprint $table){
            $table->dropColumn('finish_time');
        });
        //
    }
}
