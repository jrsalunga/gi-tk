<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHolidayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holiday', function (Blueprint $table) {
            $table->char('code', '10')->unique();
            $table->char('descriptor', '50')->nullable();
            $table->tinyInteger('type')->nullable()->default('0');
            $table->tinyInteger('isregional')->nullable()->default('0');

            $table->char('id', '32')->primary();

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
        Schema::drop('holiday');
    }
}
