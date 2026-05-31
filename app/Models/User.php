<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'cabang_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'user_id');
    }

    public function riwayatStok()
    {
        return $this->hasMany(RiwayatStok::class, 'user_id');
    }

    public function isOwner()
    {
        return $this->role === 'owner';
    }

    public function isManajer()
    {
        return $this->role === 'manajer_toko';
    }

    public function isSupervisor()
    {
        return $this->role === 'supervisor';
    }

    public function isKasir()
    {
        return $this->role === 'kasir';
    }

    public function isGudang()
    {
        return $this->role === 'pegawai_gudang';
    }
}