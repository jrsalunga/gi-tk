<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier', function (Blueprint $table) {

            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->string('code','5');
            $table->string('descriptor','60')->nullable();
            $table->string('cperson','60')->nullable();
            $table->string('addr1','60')->nullable();
            $table->string('addr2','60')->nullable();
            $table->string('tel','30')->nullable();
            $table->string('fax','30')->nullable();
            $table->string('email','30')->nullable();
            $table->string('tin','30')->nullable();
            $table->string('branchid','32')->nullable();

            $table->string('id', '32')->primary();
            //$table->increments('id');
            $table->timestamps();
            $table->index('code','CODE');
            $table->index('branchid','BRANCHID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('supplier');
    }
}
