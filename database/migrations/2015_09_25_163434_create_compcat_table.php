<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompcatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compcat', function (Blueprint $table) {
            $table->string('code', '8')->nullable();
            $table->string('descriptor','30');
            $table->string('expenseid','32');

            $table->string('id', '32')->primary();
            //$table->increments('id');
            $table->timestamps();

            $table->index('code', 'CODE');
            $table->index('expenseid','EXPENSEID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('compcat');
    }
}
