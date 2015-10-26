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
            $table->char('code','3');
            $table->char('descriptor','50')->nullable();
            $table->char('address','150')->nullable();
            $table->char('phone','20')->nullable();
            $table->char('fax','20')->nullable();
            $table->char('mobile','20')->nullable();
            $table->char('email','80')->nullable();
            $table->char('companyid','32')->nullable();
            $table->char('tin','15')->nullable();
            $table->char('managerid','32')->nullable();
            $table->char('sectorid','32')->nullable();
            $table->smallInteger('seating')->default('0');
            $table->smallInteger('area')->default('0');
            $table->smallInteger('empcount')->default('0');
            $table->decimal('mancost', 8, 2)->nullable();
            $table->decimal('longitude', 10, 4)->nullable();
            $table->decimal('latitude', 10, 4)->nullable();
            $table->date('opendate')->nullable();
            $table->text('description')->nullable();


            $table->char('id', '32')->primary();
            //$table->increments('id');
            //$table->timestamps();

            $table->index('code', 'CODE');
            $table->index('descriptor', 'DESCRIPTOR');
            $table->index('managerid', 'MANAGERID');
            $table->index('sectorid', 'SECTORID');
            $table->index('companyid', 'COMPANYID');
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
