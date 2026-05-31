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
    Schema::create('stok_barang', function (Blueprint $table) {
        $table->id();
        $table->foreignId('cabang_id')->constrained('cabang');
        $table->foreignId('barang_id')->constrained('barang');
        $table->integer('jumlah_stok')->default(0);
        $table->integer('stok_minimum')->default(5);
        $table->timestamps();

        $table->unique(['cabang_id', 'barang_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_barang');
    }
};
