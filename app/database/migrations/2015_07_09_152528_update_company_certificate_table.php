<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompanyCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('company_certificates', function(Blueprint $table){
            $table->string('name')->comment('证书名称');
            DB::statement('ALTER TABLE company_certificates MODIFY COLUMN certificate_path TEXT');
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
        Schema::table('company_certificates', function(Blueprint $table){

            $table->dropColumn('name');
            DB::statement('ALTER TABLE company_certificates MODIFY COLUMN certificate_path VARCHAR(255)');


        });
    }
}
