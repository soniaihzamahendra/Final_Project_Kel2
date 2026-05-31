<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriBarangSeeder extends Seeder
{
    public function run()
    {
        DB::table('kategori_barang')->truncate();
        DB::table('kategori_barang')->insert([
            ['nama_kategori' => 'Minuman',          'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Makanan',          'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Snack',            'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Kebutuhan Rumah',  'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Kebersihan',       'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Frozen Food',      'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}