<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('companys', function(Blueprint $table){
            $table->string('register_number')->nullable()->comment('工商注册号');
            $table->string('leader')->nullable()->comment('法人');
            $table->string('scope')->nullable()->comment('经营范围');
            $table->string('registion_type')->comment('有限责任公司');
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
        Schema::table('companys', function(Blueprint $table){
            $table->dropColumn('register_number');
            $table->dropColumn('leader');
            $table->dropColumn('scope');
        });
    }
}
