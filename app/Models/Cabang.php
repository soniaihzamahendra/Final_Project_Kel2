<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table = 'cabang';

    protected $fillable = [
        'nama_cabang', 'kota', 'alamat', 'telepon', 'is_aktif'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'cabang_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'cabang_id');
    }

    public function stokBarang()
    {
        return $this->hasMany(StokBarang::class, 'cabang_id');
    }

    public function riwayatStok()
    {
        return $this->hasMany(RiwayatStok::class, 'cabang_id');
    }
}