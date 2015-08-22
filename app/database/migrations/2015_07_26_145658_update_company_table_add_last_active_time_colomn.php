<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompanyTableAddLastActiveTimeColomn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('companies', function(Blueprint $table){
            $table->bigInteger('last_active_time')->nullable()->comment('最后活动时间');
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
        Schema::table('companies', function(Blueprint $table){
            $table->dropColumn('last_active_time');
        });
    }
}
