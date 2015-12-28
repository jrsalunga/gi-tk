<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkexpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workexp', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->char('employeeid', '32')->nullable();
            $table->char('periodfrom', '7')->nullable();
            $table->char('periodto', '7')->nullable();
            $table->char('company', '50')->nullable();
            $table->char('position', '50')->nullable();
            $table->text('remarks')->nullable();
            $table->char('id', '32')->primary();

            $table->index('employeeid', 'EMPLOYEEID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('workexp');
    }
}
