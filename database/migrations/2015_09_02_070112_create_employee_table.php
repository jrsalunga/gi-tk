<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {

            $table->string('code','10');
            $table->string('lastname','30');
            $table->string('firstname','30');
            $table->string('middlename','30');
            $table->string('position','30')->nullable();
            $table->tinyInteger('punching')->default('0');
            $table->tinyInteger('processing')->default('0');




            $table->string('id', '32')->primary();
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
        Schema::drop('employee');
    }
}
