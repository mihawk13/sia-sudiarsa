<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_pembelian', function (Blueprint $table) {
            $table->string('id', 10);
            $table->date('tanggal')->default('2020-02-02');
            $table->foreignId('kontak_id')->default(0);
            $table->foreignId('akun_id')->default(0);
            $table->double('grand_total')->default(0);
            $table->enum('status', ['On', 'Simpan'])->default('On');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_pembelian');
    }
}
