<?php

namespace Database\Seeders;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        // $data = [];

        // for ($i = 1; $i <= 200; $i++) {
        //     $data[] = [
        //         'id' => (string) Str::orderedUuid(), // UUID manual
        //         'title' => "Video Title {$i}",
        //         'url' => "https://example.com/video{$i}.mp4",
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //         'created_by' => 'admin',
        //         'updated_by' => 'admin',
        //         'is_activated' => (bool) rand(0, 1),
        //     ];
        // }

        // Video::insert($data);

        DB::table('posts')
            ->whereNull('is_activated')
            ->update(['is_activated' => 1]);
    }
}
