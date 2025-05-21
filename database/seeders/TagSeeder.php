<?php


use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        for ($i = 1; $i <= 200; $i++) {
            $name = "Tag {$i}";
            $data[] = [
                'namw' => $name, // perhatikan: kolom kamu namanya 'namw' (typo?)
                'url' => 'https://example.com/tags/' . Str::slug($name),
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => rand(1, 10),
                'updated_by' => rand(1, 10),
                'is_activated' => (bool)rand(0, 1),
            ];
        }

        Tag::insert($data);
    }
}
