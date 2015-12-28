<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position', function (Blueprint $table) {

            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->char('code', '3')->unique();
            $table->char('descriptor','50')->nullable();
            $table->tinyInteger('ordinal')->nullable();
            $table->string('id', '32')->primary();
            //$table->increments('id');
            //$table->timestamps();

            $table->index('code', 'CODE');
            $table->index('descriptor', 'DESCRIPTOR');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('position');
    }
}
