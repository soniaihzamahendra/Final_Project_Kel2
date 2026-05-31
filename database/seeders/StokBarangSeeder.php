<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokBarangSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('stok_barang')->truncate(); 
        $cabangIds = [1, 2, 3, 4, 5];
        $barangIds = range(1, 12);

        foreach ($cabangIds as $cabang) {
            foreach ($barangIds as $barang) {
                DB::table('stok_barang')->insert([
                    'cabang_id'     => $cabang,
                    'barang_id'     => $barang,
                    'jumlah_stok'   => rand(20, 100),
                    'stok_minimum'  => 5,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }
        }
    }
}