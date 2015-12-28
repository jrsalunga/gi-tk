<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->char('employeeid', '32')->nullable();
            $table->char('lastname', '30')->nullable();
            $table->char('firstname', '30')->nullable();
            $table->char('middlename', '30')->nullable();
            $table->date('birthdate');
            $table->tinyInteger('gender')->nullable();
            $table->char('acadlvlid', '32')->nullable();
            $table->char('id', '32')->primary();

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
        Schema::drop('children');
    }
}
