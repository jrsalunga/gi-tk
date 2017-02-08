<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prize', function (Blueprint $table) {

            $table->string('item', 255);
            $table->string('supplier', 255);
            $table->char('branch', 3)->nullable();
            $table->decimal('amount', 8, 2)->default('0.00');
            $table->tinyInteger('class')->nullable();
            $table->tinyInteger('assigned')->nullable();

            $table->increments('id');
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
        Schema::drop('prize');
    }
}
