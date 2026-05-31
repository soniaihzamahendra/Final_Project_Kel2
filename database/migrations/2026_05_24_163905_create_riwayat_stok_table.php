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
    Schema::create('riwayat_stok', function (Blueprint $table) {
        $table->id();
        $table->foreignId('cabang_id')->constrained('cabang');
        $table->foreignId('barang_id')->constrained('barang');
        $table->foreignId('user_id')->constrained('users');
        $table->enum('jenis', ['masuk', 'keluar']);
        $table->integer('jumlah');
        $table->integer('stok_sebelum');
        $table->integer('stok_sesudah');
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_stok');
    }
};
