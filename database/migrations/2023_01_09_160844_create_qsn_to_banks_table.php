<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQsnToBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qsn_to_banks', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_qsn_id'); //foreign key from question List table
            $table->integer('fk_bank_id'); //foreign key from question Bank table
            $table->index('fk_qsn_id');
            $table->index('fk_bank_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qsn_to_banks');
    }
}
