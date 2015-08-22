<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompanyCycleBillsAddNextDateColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_cycle_bills', function (Blueprint $table) {
            $table->timestamp('next_date')->nullable()->after('start_date')->comment('下一次缴费时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_cycle_bills', function (Blueprint $table) {
            $table->dropColumn('next_date');
        });
    }
}
