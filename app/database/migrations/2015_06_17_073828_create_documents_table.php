<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_documents', function(Blueprint $table){

            $table->increments('id');
            $table->string('document_type', 20)->comment('文档种类');
            $table->string('file_path')->comment('文档存储路径');
            $table->string('remark')->nullable()->comment('备注');
            $table->integer('company_id')->comment('公司ID');
            $table->string('volume', 11)->nullable()->comment('容量');
            $table->string('original_name')->comment('原始文件名');
            $table->string('qiniu_name')->comment('七牛文件名');
            $table->integer('user_id')->comment('代帐公司ID');
            $table->integer('operator_id');
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
        Schema::drop('company_documents');
    }
}
