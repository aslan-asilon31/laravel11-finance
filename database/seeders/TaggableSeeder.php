<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaggableSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        for ($i = 1; $i <= 200; $i++) {
            $data[] = [
                'tag_id' => rand(1, 200), // Pastikan tag_id ini ada di TagSeeder
                'taggable_id' => rand(1, 50), // Pastikan entitas target juga ada
                'taggable_type' => rand(0, 1) ? 'App\Models\Post' : 'App\Models\Video',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => rand(1, 10),
                'updated_by' => rand(1, 10),
                'is_activated' => (bool)rand(0, 1),
            ];
        }

        DB::table('taggables')->insert($data);
    }
}
