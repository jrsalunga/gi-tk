<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch', function (Blueprint $table) {
            $table->string('code','4');
            $table->string('descriptor','30')->nullable();
            $table->string('company','45')->nullable();
            $table->string('addr1','45')->nullable();
            $table->string('addr2','45')->nullable();
            $table->string('addr3','45')->nullable();
            $table->string('registered','45')->nullable();
            $table->string('tradename','45')->nullable();
            $table->string('tin','30')->nullable();
            $table->string('pospermit','30')->nullable();
            $table->string('accreditation','30')->nullable();
            $table->string('telno1','30')->nullable();
            $table->string('telno2','30')->nullable();
            $table->string('email','30')->nullable();
            $table->string('lessorid','32')->nullable();

            $table->string('id', '32')->primary();
            //$table->increments('id');
            $table->timestamps();

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
        Schema::drop('branch');
    }
}
