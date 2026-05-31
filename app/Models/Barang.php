<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'kode_barang', 'nama_barang', 'kategori_id',
        'satuan', 'harga_beli', 'harga_jual'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_id');
    }

    public function stokBarang()
    {
        return $this->hasMany(StokBarang::class, 'barang_id');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'barang_id');
    }

    public function riwayatStok()
    {
        return $this->hasMany(RiwayatStok::class, 'barang_id');
    }
}