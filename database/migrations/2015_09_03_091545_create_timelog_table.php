<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimelogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timelog', function (Blueprint $table) {
            $table->string('employeeid','32');
            //$table->foreign('employee')->references('id')->on('employee');
            $table->dateTime('datetime');
            $table->string('txncode','2');
            $table->tinyInteger('entrytype');
            $table->string('terminal','30');

            $table->string('id', '32')->primary();
            //$table->increments('id');
            $table->timestamps();

            $table->index('employeeid', 'EMPLOYEEID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('timelog');
    }
}
