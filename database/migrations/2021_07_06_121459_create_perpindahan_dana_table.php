<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerpindahanDanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perpindahan_dana', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('dari');
            $table->foreignId('ke');
            $table->string('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perpindahan_dana');
    }
}
