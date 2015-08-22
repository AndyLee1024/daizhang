<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompanyTaxRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('company_tax_record', function(Blueprint $table){

            $table->string('card_name')->comment('税务申报卡片名称');
            $table->integer('flag')->comment('每个月的标示 比如201412');
            DB::statement('ALTER TABLE company_tax_record MODIFY COLUMN finish_time INTEGER ');


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
        Schema::table('company_tax_record', function(Blueprint $table){
            $table->dropColumn('card_name');
            $table->dropColumn('flag');
            DB::statement('ALTER TABLE company_tax_record MODIFY COLUMN finish_time CHAR 20');

        });

    }
}
