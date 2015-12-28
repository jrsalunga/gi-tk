<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component', function (Blueprint $table) {

            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->string('code', '8')->nullable();
            $table->string('descriptor','30');
            $table->string('compcatid','32')->nullable();
            $table->decimal('cost', 5, 2)->default('0.00');
            $table->string('uom','10')->nullable();
            $table->tinyInteger('active')->default(1);
           
            $table->string('id', '32')->primary();
            //$table->increments('id');
            $table->timestamps();

            $table->index('code', 'CODE');
            $table->index('compcatid','COMPCATID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('component');
    }
}
