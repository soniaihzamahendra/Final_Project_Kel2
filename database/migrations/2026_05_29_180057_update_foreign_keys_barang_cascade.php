<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
    
        Schema::table('stok_barang', function (Blueprint $table) {
            $table->dropForeign(['barang_id']);
            $table->foreign('barang_id')
                  ->references('id')->on('barang')
                  ->cascadeOnDelete();
        });

        Schema::table('detail_transaksi', function (Blueprint $table) {
            $table->dropForeign(['barang_id']);
            $table->foreign('barang_id')
                  ->references('id')->on('barang')
                  ->cascadeOnDelete();
        });

        Schema::table('riwayat_stok', function (Blueprint $table) {
            $table->dropForeign(['barang_id']);
            $table->foreign('barang_id')
                  ->references('id')->on('barang')
                  ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::table('stok_barang', function (Blueprint $table) {
            $table->dropForeign(['barang_id']);
            $table->foreign('barang_id')->references('id')->on('barang');
        });

        Schema::table('detail_transaksi', function (Blueprint $table) {
            $table->dropForeign(['barang_id']);
            $table->foreign('barang_id')->references('id')->on('barang');
        });

        Schema::table('riwayat_stok', function (Blueprint $table) {
            $table->dropForeign(['barang_id']);
            $table->foreign('barang_id')->references('id')->on('barang');
        });
    }
};