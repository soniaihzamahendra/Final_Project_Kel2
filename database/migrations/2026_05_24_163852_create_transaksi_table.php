<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('transaksi', function (Blueprint $table) {
        $table->id();
        $table->string('no_transaksi')->unique();
        $table->foreignId('cabang_id')->constrained('cabang');
        $table->foreignId('user_id')->constrained('users'); 
        $table->enum('jenis', ['penjualan', 'pembelian']);
        $table->decimal('total_harga', 15, 2);
        $table->decimal('bayar', 15, 2)->nullable();
        $table->decimal('kembalian', 15, 2)->nullable();
        $table->text('keterangan')->nullable();
        $table->timestamp('tanggal_transaksi');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
