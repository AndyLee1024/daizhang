<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCompanyTableTimep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement('ALTER TABLE companys MODIFY COLUMN register_time INTEGER(11)');
        DB::statement('ALTER TABLE companys MODIFY COLUMN end_time INTEGER(11)');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        DB::statement('ALTER TABLE companys MODIFY COLUMN register_time VARCHAR(255)');
        DB::statement('ALTER TABLE companys MODIFY COLUMN end_time VARCHAR (255)');

    }
}
