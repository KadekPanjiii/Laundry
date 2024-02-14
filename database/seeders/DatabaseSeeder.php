<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //SEEDER UNTUK TABLE Outlet
        DB::table('tb_outlet')->insert([
            'nama' => 'Outlet 1',
            'alamat' => 'Jl. Contoh No. 123',
            'tlp' => '628123456789',
        ]);
        DB::table('tb_outlet')->insert([
            'nama' => 'Outlet 2',
            'alamat' => 'Jl. Percobaan No. 456',
            'tlp' => '628567890123',
        ]);

        
        //SEEDER UNTUK TABLE PAKET
        DB::table('tb_paket')->insert([
            'jenis' => 'kiloan',
            'nama_paket' => 'Paket Kiloan',
            'harga' => 5000,
        ]);

        DB::table('tb_paket')->insert([
            'jenis' => 'selimut',
            'nama_paket' => 'Paket Selimut',
            'harga' => 10000,
        ]);

        DB::table('tb_paket')->insert([
            'jenis' => 'bed_cover',
            'nama_paket' => 'Paket Bed Cover',
            'harga' => 15000,
        ]);

        DB::table('tb_paket')->insert([
            'jenis' => 'kaos',
            'nama_paket' => 'Paket Kaos',
            'harga' => 7000,
        ]);

        DB::table('tb_paket')->insert([
            'jenis' => 'lain',
            'nama_paket' => 'Paket Lain',
            'harga' => 8000,
        ]);

        //SEEDER UNTUK TABLE MEMBER
        DB::table('tb_member')->insert([
            'nama' => 'John Doe',
            'alamat' => 'Jl. Contoh No. 123',
            'jenis_kelamin' => 'L',
            'tlp' => '628123456789',
        ]);
        DB::table('tb_member')->insert([
            'nama' => 'Jane Doe',
            'alamat' => 'Jl. Percobaan No. 456',
            'jenis_kelamin' => 'P',
            'tlp' => '628567890123',
        ]);

        //SEEDER UNTUK TABLE USER
        DB::table('tb_user')->insert([
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'id_outlet' => '1',
            'role' => 'admin',
        ]);
        DB::table('tb_user')->insert([
            'nama' => 'Kasir',
            'username' => 'kasir',
            'password' => bcrypt('kasir'),
            'id_outlet' => '1',
            'role' => 'kasir',
        ]);
        DB::table('tb_user')->insert([
            'nama' => 'Owner',
            'username' => 'owner',
            'password' => bcrypt('owner'),
            'id_outlet' => '1',
            'role' => 'owner',
        ]);
    }
}
