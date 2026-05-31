<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run()
    {
        DB::table('barang')->truncate();
        DB::table('barang')->insert([
          
            ['kode_barang' => 'BRG001', 'nama_barang' => 'Aqua 600ml',        'kategori_id' => 1, 'satuan' => 'botol', 'harga_beli' => 2500,  'harga_jual' => 4000,  'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG002', 'nama_barang' => 'Teh Botol Sosro',   'kategori_id' => 1, 'satuan' => 'botol', 'harga_beli' => 4000,  'harga_jual' => 6000,  'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG003', 'nama_barang' => 'Coca Cola 330ml',   'kategori_id' => 1, 'satuan' => 'kaleng','harga_beli' => 6000,  'harga_jual' => 9000,  'created_at' => now(), 'updated_at' => now()],

            
            ['kode_barang' => 'BRG004', 'nama_barang' => 'Indomie Goreng',    'kategori_id' => 2, 'satuan' => 'bungkus','harga_beli' => 2800, 'harga_jual' => 4000,  'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG005', 'nama_barang' => 'Beras 5kg',         'kategori_id' => 2, 'satuan' => 'kg',    'harga_beli' => 55000, 'harga_jual' => 70000, 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG006', 'nama_barang' => 'Minyak Goreng 1L',  'kategori_id' => 2, 'satuan' => 'liter', 'harga_beli' => 14000, 'harga_jual' => 18000, 'created_at' => now(), 'updated_at' => now()],

            
            ['kode_barang' => 'BRG007', 'nama_barang' => 'Chitato 68gr',      'kategori_id' => 3, 'satuan' => 'bungkus','harga_beli' => 8000, 'harga_jual' => 12000, 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG008', 'nama_barang' => 'Oreo Original',     'kategori_id' => 3, 'satuan' => 'bungkus','harga_beli' => 5000, 'harga_jual' => 8000,  'created_at' => now(), 'updated_at' => now()],

           
            ['kode_barang' => 'BRG009', 'nama_barang' => 'Gula Pasir 1kg',    'kategori_id' => 4, 'satuan' => 'kg',    'harga_beli' => 13000, 'harga_jual' => 16000, 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG010', 'nama_barang' => 'Sabun Mandi Lifebuoy','kategori_id' => 5,'satuan' => 'pcs',  'harga_beli' => 4000,  'harga_jual' => 6500,  'created_at' => now(), 'updated_at' => now()],

           
            ['kode_barang' => 'BRG011', 'nama_barang' => 'Nugget So Good 500gr','kategori_id' => 6,'satuan' => 'bungkus','harga_beli' => 28000,'harga_jual' => 38000, 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG012', 'nama_barang' => 'Sosis Kimbo',        'kategori_id' => 6, 'satuan' => 'bungkus','harga_beli' => 18000,'harga_jual' => 25000, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}