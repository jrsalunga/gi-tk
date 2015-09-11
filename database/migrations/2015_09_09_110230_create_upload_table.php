<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload', function (Blueprint $table) {
            
            $table->string('filename','30');
            $table->string('filetype','30');
            $table->string('terminal','30');
            $table->string('employeeid','32');

            $table->string('id', '32')->primary();
            //$table->increments('id');
            $table->timestamps();

            $table->index('employeeid', 'EMPLOYEEID');
            $table->index('filename','FILENAME');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('upload');
    }
}
