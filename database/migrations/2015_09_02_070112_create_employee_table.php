<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {

            $table->char('code','6')->unique();
            $table->char('lastname','30');
            $table->char('firstname','30');
            $table->char('middlename','30');
            $table->char('companyid','32');
            $table->char('branchid','32');
            $table->char('deptid','32');
            $table->char('positionid','32');
            $table->tinyInteger('paytype')->nullable();
            $table->tinyInteger('ratetype')->nullable();
            $table->decimal('rate', 12, 2)->default('0.00');
            $table->char('sssno','12')->nullable();
            $table->char('phicno','12')->nullable();
            $table->char('hdmfno','14')->nullable();
            $table->char('taxidno','15')->nullable();
            $table->tinyInteger('empstatus')->nullable();
            $table->tinyInteger('punching')->default(1);
            $table->tinyInteger('processing')->default(1);
            //$table->char('rfid', '10')->nullable();
            $table->char('address','120')->nullable();
            $table->char('phone','20')->nullable();
            $table->char('fax','20')->nullable();
            $table->char('mobile','20')->nullable();
            $table->char('email','80')->nullable();
            $table->tinyInteger('gender')->default(1);
            $table->tinyInteger('civstatus')->default(1);
            $table->decimal('height', 12, 2)->default('0.00');
            $table->decimal('weight', 12, 2)->default('0.00');
            $table->date('birthdate')->nullable();
            $table->char('birthplace','30')->nullable();
            $table->char('religionid','30')->nullable();
            $table->char('hobby','50')->nullable();
            $table->text('notes')->nullable();

            $table->char('id', '32')->primary();
            //$table->timestamps();

            $table->index('code', 'CODE');
            $table->index('firstname', 'FIRSTNAME');
            $table->index('lastname', 'LASTNAME');
            $table->index('middlename', 'MIDDLENAME');
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
        Schema::drop('employee');
    }
}
