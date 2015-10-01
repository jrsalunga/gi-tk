<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManskeddtlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manskeddtl', function (Blueprint $table) {
            $table->char('mandayid', '32')->nullable();
            $table->char('employeeid', '32');
            $table->tinyInteger('daytype')->nullable();
            $table->char('starttime', '5')->nullable();
            $table->char('id', '32')->primary();
            //$table->increments('id');
            //$table->timestamps();
            $table->index('mandayid', 'MANDAYID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('manskeddtl');
    }
}
