<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimelogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timelog', function (Blueprint $table) {

            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->char('employeeid','32');
            $table->char('rfid','10');
            $table->dateTime('datetime');
            $table->tinyInteger('txncode');
            $table->tinyInteger('entrytype');
            $table->char('terminalid','15');
            $table->timestamp('createdate')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->char('id', '32')->primary();
            //$table->increments('id');
            //$table->timestamps();
            //$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('employeeid', 'EMPLOYEEID');
            $table->index('rfid', 'RFID');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('timelog');
    }
}
