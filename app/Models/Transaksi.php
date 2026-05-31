<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'no_transaksi', 'cabang_id', 'user_id', 'jenis',
        'total_harga', 'bayar', 'kembalian', 'keterangan', 'tanggal_transaksi'
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }

    public static function generateNoTransaksi($jenis)
    {
        $prefix = $jenis === 'penjualan' ? 'TRX-JL' : 'TRX-BL';
        $count  = self::where('jenis', $jenis)->count() + 1;
        return $prefix . '-' . date('Ymd') . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
}