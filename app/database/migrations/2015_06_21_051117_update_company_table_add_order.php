<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompanyTableAddOrder extends Migration
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
            $table->string('order', 1)->nullable()->comment('按首字母排序用');
            $table->string('uuid', 36);

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
            $table->dropColumn('order');
            $table->dropColumn('uuid');
        });
    }
}
