<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spouse', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->char('employeeid', '32')->nullable();
            $table->char('lastname', '30')->nullable();
            $table->char('firstname', '30')->nullable();
            $table->char('middlename', '30')->nullable();
            $table->date('birthdate');
            $table->char('address', '120')->nullable();
            $table->char('phone', '20')->nullable();
            $table->char('fax', '20')->nullable();
            $table->char('mobile', '20')->nullable();
            $table->char('email', '80')->nullable();
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
        Schema::drop('spouse');
    }
}
