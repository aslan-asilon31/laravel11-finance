<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Image;

class ImageSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        for ($i = 1; $i <= 200; $i++) {
            $data[] = [
                'id' => (string) Str::orderedUuid(), // UUID manual
                'url' => "https://example.com/image{$i}.jpg",
                'imageable_id' => rand(1, 50),
                'imageable_type' => rand(0, 1) ? 'App\Models\Post' : 'App\Models\User',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 'admin',
                'updated_by' => 'admin',
                'is_activated' => (bool)rand(0, 1),
            ];
        }

        Image::insert($data);
    }
}
