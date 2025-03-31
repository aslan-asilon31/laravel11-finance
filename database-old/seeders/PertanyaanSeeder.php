<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pertanyaan;
use App\Models\Asesmen;
use Illuminate\Support\Str;

class PertanyaanSeeder extends Seeder
{
    public function run(): void
    {


        // Soal Pilihan Ganda
        Pertanyaan::create([
            'id' => Str::uuid(),
            'asesmen_id' => "1c111350-7552-4a89-8b8f-aef8a1551073",
            'pertanyaan' => 'Apa yang menjadi keunggulan utama dari Hair Dryer UTH700 dibandingkan dengan pengering rambut lainnya?',
            'jenis' => 'essay',
            'durasi' => 60, // 1 menit
            'bobot' => 10,
            'dibuat_oleh' => 'admin',
            'no_urut' => 1,
            'apa_aktif' => 1,
        ]);

        Pertanyaan::create([
            'id' => Str::uuid(),
            'asesmen_id' => "1c111350-7552-4a89-8b8f-aef8a1551073",
            'pertanyaan' => 'Bagaimana Tomo R8 mengenali dan memetakan ruangan?',
            'jenis' => 'essay',
            'durasi' => 60, // 1 menit
            'bobot' => 10,
            'dibuat_oleh' => 'admin',
            'no_urut' => 2,
            'apa_aktif' => 1,

        ]);

        // Soal Essay
        Pertanyaan::create([
            'id' => Str::uuid(),
            'asesmen_id' =>"1c111350-7552-4a89-8b8f-aef8a1551073",
            'pertanyaan' => 'Apa manfaat dari fungsi sterilisasi yang dimiliki oleh Tomo R8?',
            'jenis' => 'essay',
            'durasi' => 120, // 2 menit
            'bobot' => 20,
            'dibuat_oleh' => 'admin',
            'no_urut' => 3,
            'apa_aktif' => 1,
        ]);

        Pertanyaan::create([
            'id' => Str::uuid(),
            'asesmen_id' => "1c111350-7552-4a89-8b8f-aef8a1551073",
            'pertanyaan' => 'Apa yang membedakan Tomo R8 dari vacuum cleaner biasa?',
            'jenis' => 'essay',
            'durasi' => 120, // 2 menit
            'bobot' => 20,
            'dibuat_oleh' => 'admin',
            'no_urut' => 4,
            'apa_aktif' => 1,
        ]);

        Pertanyaan::create([
            'id' => Str::uuid(),
            'asesmen_id' => "1c111350-7552-4a89-8b8f-aef8a1551073",
            'pertanyaan' => 'Apa saja fungsi utama dari Tomo R8 Smart Robot Vacuum and Mop Combo?',
            'jenis' => 'essay',
            'durasi' => 60, // 2 menit
            'bobot' => 10,
            'dibuat_oleh' => 'admin',
            'no_urut' => 5,
            'apa_aktif' => 1,
        ]);
    }
}
