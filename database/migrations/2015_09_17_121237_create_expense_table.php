<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense', function (Blueprint $table) {
            
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->string('code', '5');
            $table->string('descriptor','30');
            $table->string('expscatid','32')->nullable();
            $table->string('ordinal', '5')->nullable();
            //$table->integer('ordinal', '5')->unsigned();
            $table->string('desc1','60')->nullable();
            $table->string('desc2','60')->nullable();
            $table->string('desc3','60')->nullable();
            $table->string('desc4','60')->nullable();
            $table->string('desc5','60')->nullable();

            $table->string('id', '32')->primary();
            //$table->increments('id');
            $table->timestamps();

            $table->index('expscatid', 'EXPSCATID');
            $table->index('code','CODE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('expense');
    }
}
