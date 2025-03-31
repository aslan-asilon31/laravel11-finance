<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AsesmenUserDetail;
use Illuminate\Support\Str;

class AsesmenUserDetailSeeder extends Seeder
{
    public function run()
    {
        // Contoh data untuk seeder
        $data = [
            [
                'id' => Str::uuid(),
                'pengguna_asesmen_id' => 'uuid-asesmen-user-1', // Ganti dengan UUID yang valid
                'pertanyaan_id' => 'uuid-pertanyaan-1', // Ganti dengan UUID yang valid
            ],
            [
                'id' => Str::uuid(),
                'pengguna_asesmen_id' => 'uuid-asesmen-user-2', // Ganti dengan UUID yang valid
                'pertanyaan_id' => 'uuid-pertanyaan-2', // Ganti dengan UUID yang valid
            ],
            // Tambahkan lebih banyak data sesuai kebutuhan
        ];

        foreach ($data as $item) {
            AsesmenUserDetail::create($item);
        }
    }
}
