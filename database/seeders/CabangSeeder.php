<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CabangSeeder extends Seeder
{
    public function run()
    {
        DB::table('cabang')->truncate();
        DB::table('cabang')->insert([
            ['nama_cabang' => 'Jayusman Mart Pusat',    'kota' => 'Jakarta',    'alamat' => 'Jl. Sudirman No.1',       'telepon' => '021-1111111', 'is_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama_cabang' => 'Jayusman Mart Bandung',  'kota' => 'Bandung',    'alamat' => 'Jl. Dago No.5',           'telepon' => '022-2222222', 'is_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama_cabang' => 'Jayusman Mart Cianjur', 'kota' => 'Cianjur', 'alamat' => 'Jl. Siliwangi No.10',         'telepon' => '0263-123456', 'is_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama_cabang' => 'Jayusman Mart Yogya',    'kota' => 'Yogyakarta', 'alamat' => 'Jl. Malioboro No.10',     'telepon' => '0274-444444', 'is_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nama_cabang' => 'Jayusman Mart Medan',    'kota' => 'Medan',      'alamat' => 'Jl. Gatot Subroto No.7',  'telepon' => '061-5555555', 'is_aktif' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}