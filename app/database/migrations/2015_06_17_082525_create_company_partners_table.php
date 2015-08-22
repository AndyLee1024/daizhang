<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('company_partners', function(Blueprint $table){
            $table->increments('id');
            $table->integer('company_id');
            $table->integer('operator_id');
            $table->string('name')->comment('股东名称');
            $table->decimal('credits')->nullable()->comment('出资金额');
            $table->string('certificate')->nullable()->comment('证件类型');
            $table->string('certificate_number')->nullable()->comment('证件号码');
            $table->string('post')->nullable()->comment('职位');
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
        Schema::drop('company_partners');
    }
}
