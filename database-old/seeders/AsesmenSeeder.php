<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asesmen;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AsesmenSeeder extends Seeder
{
    public function run()
    {
        // Membuat 20 judul tentang produk appliances
        $questions = [
            [
                'id' => Str::uuid(),
                'judul' => 'Apa fungsi utama dari mesin cuci?',
                'deskripsi' => 'Menjelaskan fungsi dasar dari mesin cuci dalam proses mencuci pakaian.',
                'durasi' => 30,
                'apa_aktif' => true,
                'tgl_mulai' => Carbon::now(),
                'tgl_selesai' => Carbon::now()->addHours(1),
                'dibuat_oleh' => 'admin@example.com',
                'diupdate_oleh' => 'admin@example.com',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'judul' => 'Apa keuntungan menggunakan oven listrik?',
                'deskripsi' => 'Membahas keuntungan dan kemudahan yang ditawarkan oleh oven listrik.',
                'durasi' => 45,
                'apa_aktif' => true,
                'tgl_mulai' => Carbon::now(),
                'tgl_selesai' => Carbon::now()->addHours(1),
                'dibuat_oleh' => 'admin@example.com',
                'diupdate_oleh' => 'admin@example.com',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
            ],
            [
                'id' => Str::uuid(),
                'judul' => 'Bagaimana cara merawat kulkas?',
                'deskripsi' => 'Menjelaskan langkah-langkah perawatan dan pemeliharaan kulkas.',
                'durasi' => 60,
                'apa_aktif' => true,
                'tgl_mulai' => Carbon::now(),
                'tgl_selesai' => Carbon::now()->addHours(1),
                'dibuat_oleh' => 'admin@example.com',
                'diupdate_oleh' => 'admin@example.com',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
            ],
        ];

        // Menyimpan pertanyaan ke dalam database
        foreach ($questions as $question) {
            Asesmen::create($question);
        }
    }
}
