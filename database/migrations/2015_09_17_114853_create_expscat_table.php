<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpscatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expscat', function (Blueprint $table) {
            $table->string('code', '5')->unique();
            $table->string('descriptor','30');

            $table->string('id', '32')->primary();
            //$table->increments('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('expscat');
    }
}
