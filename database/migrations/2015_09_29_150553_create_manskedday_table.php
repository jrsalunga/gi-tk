<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManskeddayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manskedday', function (Blueprint $table) {
            $table->char('manskedid', '32')->nullable();
            $table->date('date');
            $table->smallInteger('custcount')->nullable();
            $table->smallInteger('headspend')->nullable();
            $table->tinyInteger('empcount')->nullable();
            $table->char('id', '32')->primary();
            //$table->increments('id');
            //$table->timestamps();
            $table->index('manskedid', 'MANSKEDID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('manskedday');
    }
}