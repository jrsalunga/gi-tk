<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManskedhdrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manskedhdr', function (Blueprint $table) {

            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->char('refno', '10')->unique();
            $table->date('date');
            $table->char('branchid', '32');
            $table->char('managerid', '32');
            $table->decimal('mancost', 8, 2)->default('0.00');
            $table->tinyInteger('weekno');
            $table->smallInteger('year');
            $table->text('notes')->nullable();
            //$table->timestamp('createdate');
            $table->timestamp('createdate')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->char('id', '32')->primary();
            //$table->increments('id');
            //$table->timestamps();
            $table->index('refno', 'REFNO');
            $table->index('branchid', 'BRANCHID');
            $table->index('managerid', 'MANAGERID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('manskedhdr');
    }
}
