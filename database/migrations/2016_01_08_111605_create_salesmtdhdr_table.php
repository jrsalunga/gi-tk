<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesmtdhdrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesmtdhdr', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            
            $table->string('year', '4')->default(0);
            $table->tinyInteger('month')->default(0);
            $table->time('time')->dafault('00:00:00');
            $table->mediumInteger('mon')->default(0);
            $table->mediumInteger('tue')->default(0);
            $table->mediumInteger('wed')->default(0);
            $table->mediumInteger('thu')->default(0);
            $table->mediumInteger('fri')->default(0);
            $table->mediumInteger('sat')->default(0);
            $table->mediumInteger('sun')->default(0);
            
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
        Schema::drop('salesmtdhdr');
    }
}
