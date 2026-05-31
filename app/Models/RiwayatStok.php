<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatStok extends Model
{
    protected $table = 'riwayat_stok';

    protected $fillable = [
        'cabang_id', 'barang_id', 'user_id', 'jenis',
        'jumlah', 'stok_sebelum', 'stok_sesudah', 'keterangan'
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}