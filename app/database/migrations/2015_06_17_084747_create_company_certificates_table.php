<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('company_certificates', function(Blueprint $table){
            $table->increments('id');
            $table->integer('company_id');
            $table->integer('operator_id');
            $table->string('certificate_type')->nullable()->comment('证件类型');
            $table->string('certificate_number')->nullable()->comment('证件号码');
            $table->string('certificate_path')->nullable()->comment('证件路径');
            $table->text('remarks')->nullable();
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
        Schema::drop('company_certificates');
    }
}
