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

            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->char('mandayid', '32')->nullable();
            $table->char('employeeid', '32');
            $table->tinyInteger('daytype')->nullable();
            $table->char('timestart', '5')->nullable();
            $table->char('breakstart', '5')->nullable();
            $table->char('breakend', '5')->nullable();
            $table->char('timeend', '5')->nullable();
            $table->decimal('workhrs', 8, 2)->default('0.00');
            $table->decimal('breakhrs', 8, 2)->default('0.00');
            $table->decimal('loading', 8, 2)->default('0.00');
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
