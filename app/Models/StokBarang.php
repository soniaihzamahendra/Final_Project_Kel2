<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    protected $table = 'stok_barang';

    protected $fillable = [
        'cabang_id', 'barang_id', 'jumlah_stok', 'stok_minimum'
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function isStokMenupis()
    {
        return $this->jumlah_stok <= $this->stok_minimum;
    }
}