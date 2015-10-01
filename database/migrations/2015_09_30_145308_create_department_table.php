<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department', function (Blueprint $table) {
            $table->char('code', '3')->unique();
            $table->char('descriptor','50')->nullable();

            $table->char('id', '32')->primary();
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
        Schema::drop('department');
    }
}
