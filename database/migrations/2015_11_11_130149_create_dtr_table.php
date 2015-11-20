<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDtrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtr', function (Blueprint $table) {
            $table->char('employeeid', '32');
            $table->date('date');
            $table->tinyInteger('daytype')->default('0');
            $table->char('timestart','5')->default('');
            $table->char('breakstart','5')->default('');
            $table->char('breakend','5')->default('');
            $table->char('timeend','5')->default('');
            $table->char('timein','5')->default('');
            $table->char('breakin','5')->default('');
            $table->char('breakout','5')->default('');
            $table->char('timeout','5')->default('');
            $table->tinyInteger('isabsent')->default('0');
            $table->decimal('tardyhrs', 7, 4)->default('0.0000');
            $table->decimal('reghrs', 7, 4)->default('0.0000');
            $table->decimal('othrs', 7, 4)->default('0.0000');
            $table->decimal('rhhrs', 7, 4)->default('0.0000');
            $table->decimal('rhothrs', 7, 4)->default('0.0000');
            $table->decimal('shhrs', 7, 4)->default('0.0000');
            $table->decimal('shothrs', 7, 4)->default('0.0000');
            $table->decimal('rdhrs', 7, 4)->default('0.0000');
            $table->decimal('rdothrs', 7, 4)->default('0.0000');
            $table->decimal('rdrhhrs', 7, 4)->default('0.0000');
            $table->decimal('rdrhothrs', 7, 4)->default('0.0000');
            $table->decimal('rdshhrs', 7, 4)->default('0.0000');
            $table->decimal('rdshothrs', 7, 4)->default('0.0000');
            $table->decimal('ndiffhrs', 7, 4)->default('0.0000');
            $table->decimal('uthrs', 7, 4)->default('0.0000');
            $table->decimal('leavehrs', 7, 4)->default('0.0000');
            $table->decimal('approved', 7, 4)->default('0.0000');
            $table->tinyInteger('mealcount')->default('0');

            $table->char('id', '32')->primary();

            $table->index('employeeid', 'EMPLOYEEID');
            $table->index('date', 'DATE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dtr');
    }
}
