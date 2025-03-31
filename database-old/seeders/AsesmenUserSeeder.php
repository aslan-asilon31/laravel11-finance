<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AsesmenUser;
use Illuminate\Support\Str;

class AsesmenUserSeeder extends Seeder
{
    public function run()
    {
        AsesmenUser::create([
            'id' => Str::uuid(),
            'pengguna_id' => 1, // Ganti dengan ID user yang valid
            'asesmen_id' => 'your-asesmen-uuid', // Ganti dengan UUID asesmen yang valid
            'tgl_mulai' => now(),
            'tgl_selesai' => now()->addHours(1), // Misalnya, 1 jam setelah mulai
        ]);

        // Tambahkan lebih banyak data jika diperlukan
    }
}
