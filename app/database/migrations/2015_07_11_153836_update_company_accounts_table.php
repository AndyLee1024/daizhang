<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompanyAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('company_accounts', function(Blueprint $table){
            $table->string('site_name')->comment('登录平台名称');
            $table->string('favicon_url')->comment('网站icon地址');
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
        Schema::table('company_accounts', function(Blueprint $table){
            $table->dropColumn('site_name');
            $table->dropColumn('favicon_url');
        });
    }
}
