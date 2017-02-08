<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesmtdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesmtd', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            
            $table->string('tblno', '4')->nullable();
            $table->string('wtrno', '4')->nullable();
            $table->string('ordno', '6')->nullable();
            $table->string('cusno', '4')->nullable();
            $table->mediumInteger('cuscount')->nullable();
            $table->string('cusname', '20')->nullable();
            $table->string('prodno', '8')->nullable();
            $table->string('prodname', '20')->nullable();
            $table->date('orddate')->nullable();
            $table->time('ordtime')->nullable();
            $table->string('catname', '20')->nullable();
            $table->string('record', '6')->nullable();
            
            
            $table->string('branchid', '32')->nullable();
            $table->string('id', '32')->primary();

            $table->index('branchid', 'BRANCHID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('salesmtd');
    }
}
