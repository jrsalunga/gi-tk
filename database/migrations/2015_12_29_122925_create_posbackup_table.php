<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosbackupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posbackup', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->char('branchid', '32')->nullable();
            $table->char('filename', '12')->nullable();
            $table->char('size', '12')->nullable();
            $table->char('mimetype', '20')->nullable();
            $table->char('year', '4')->nullable();
            $table->char('month', '2')->nullable();
            $table->timestamp('uploaddate')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->tinyInteger('processed')->default(0);
            $table->text('remarks')->nullable();
            $table->char('terminal', '12')->nullable();
            $table->char('userid', '32')->nullable();
            $table->char('id', '32')->primary();

            $table->index('branchid', 'EMPLOYEEID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posbackup');
    }
}
