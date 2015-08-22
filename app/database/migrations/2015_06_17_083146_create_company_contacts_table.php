<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('company_contacts', function(Blueprint $t){
            $t->increments('id');
            $t->integer('company_id');
            $t->integer('operator_id');
            $t->string('name')->comment('联系人名称');
            $t->string('post')->nullable()->comment('职位');
            $t->string('mobile', 11)->comment('手机号码');
            $t->string('email')->nullable()->comment('电子邮件');
            $t->text('remarks')->nullable();
            $t->tinyInteger('is_default')->default(0)->comment('是否默认联系人0否1是 每个公司只能1个');
            $t->timestamps();
            $t->softDeletes();
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
        Schema::drop('company_contacts');
    }
}
