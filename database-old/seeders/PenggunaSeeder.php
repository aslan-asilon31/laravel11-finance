<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        // Membuat 20 Pengguna dengan peran 'customer'
        for ($i = 1; $i <= 20; $i++) {
            Pengguna::create([
                'id' => Str::uuid(),
                'nama' => 'Customer ' . $i,
                'surel' => 'customer' . $i . '@example.com',
                'sandi' => Hash::make('123123123'), // Menggunakan password yang di-hash
                'dibuat_oleh' => 'admin@example.com',
                'diupdate_oleh' => 'admin@example.com',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
            ]);
        }

        // Membuat 2 Pengguna dengan peran 'employee'
        for ($i = 1; $i <= 2; $i++) {
            Pengguna::create([
                'id' => Str::uuid(),
                'nama' => 'Employee ' . $i,
                'surel' => 'employee' . $i . '@example.com',
                'sandi' => Hash::make('123123123'), // Menggunakan password yang di-hash
                'dibuat_oleh' => 'admin@example.com',
                'diupdate_oleh' => 'admin@example.com',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
            ]);
        }
    }
}
