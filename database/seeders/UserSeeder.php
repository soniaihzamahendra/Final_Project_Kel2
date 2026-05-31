<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            
            [
                'name'       => 'Bapak Jayusman',
                'email'      => 'owner@jayusman.com',
                'password'   => Hash::make('password'),
                'role'       => 'owner',
                'cabang_id'  => null,
                'created_at' => now(), 'updated_at' => now()
            ],

            // Manajer Toko per cabang
            ['name' => 'Manajer Jakarta',    'email' => 'manajer.jakarta@jayusman.com',    'password' => Hash::make('password'), 'role' => 'manajer_toko',    'cabang_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Manajer Bandung',    'email' => 'manajer.bandung@jayusman.com',    'password' => Hash::make('password'), 'role' => 'manajer_toko',    'cabang_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Manajer Cianjur',   'email' => 'manajer.Cianjur@jayusman.com',   'password' => Hash::make('password'), 'role' => 'manajer_toko',    'cabang_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Manajer Yogya',      'email' => 'manajer.yogya@jayusman.com',      'password' => Hash::make('password'), 'role' => 'manajer_toko',    'cabang_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Manajer Medan',      'email' => 'manajer.medan@jayusman.com',      'password' => Hash::make('password'), 'role' => 'manajer_toko',    'cabang_id' => 5, 'created_at' => now(), 'updated_at' => now()],

            // Supervisor per cabang
            ['name' => 'Supervisor Jakarta',  'email' => 'spv.jakarta@jayusman.com',  'password' => Hash::make('password'), 'role' => 'supervisor', 'cabang_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Supervisor Bandung',  'email' => 'spv.bandung@jayusman.com',  'password' => Hash::make('password'), 'role' => 'supervisor', 'cabang_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Supervisor Cianjur', 'email' => 'spv.Cianjur@jayusman.com', 'password' => Hash::make('password'), 'role' => 'supervisor', 'cabang_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Supervisor Yogya',    'email' => 'spv.yogya@jayusman.com',    'password' => Hash::make('password'), 'role' => 'supervisor', 'cabang_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Supervisor Medan',    'email' => 'spv.medan@jayusman.com',    'password' => Hash::make('password'), 'role' => 'supervisor', 'cabang_id' => 5, 'created_at' => now(), 'updated_at' => now()],

            // Kasir per cabang
            ['name' => 'Kasir Jakarta',   'email' => 'kasir.jakarta@jayusman.com',   'password' => Hash::make('password'), 'role' => 'kasir', 'cabang_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kasir Bandung',   'email' => 'kasir.bandung@jayusman.com',   'password' => Hash::make('password'), 'role' => 'kasir', 'cabang_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kasir Cianjur',  'email' => 'kasir.Cianjur@jayusman.com',  'password' => Hash::make('password'), 'role' => 'kasir', 'cabang_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kasir Yogya',     'email' => 'kasir.yogya@jayusman.com',     'password' => Hash::make('password'), 'role' => 'kasir', 'cabang_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kasir Medan',     'email' => 'kasir.medan@jayusman.com',     'password' => Hash::make('password'), 'role' => 'kasir', 'cabang_id' => 5, 'created_at' => now(), 'updated_at' => now()],

            // Pegawai Gudang per cabang
            ['name' => 'Gudang Jakarta',   'email' => 'gudang.jakarta@jayusman.com',   'password' => Hash::make('password'), 'role' => 'pegawai_gudang', 'cabang_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gudang Bandung',   'email' => 'gudang.bandung@jayusman.com',   'password' => Hash::make('password'), 'role' => 'pegawai_gudang', 'cabang_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gudang Cianjur',  'email' => 'gudang.Cianjur@jayusman.com',  'password' => Hash::make('password'), 'role' => 'pegawai_gudang', 'cabang_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gudang Yogya',     'email' => 'gudang.yogya@jayusman.com',     'password' => Hash::make('password'), 'role' => 'pegawai_gudang', 'cabang_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gudang Medan',     'email' => 'gudang.medan@jayusman.com',     'password' => Hash::make('password'), 'role' => 'pegawai_gudang', 'cabang_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}