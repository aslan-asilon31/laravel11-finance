<?php


use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        for ($i = 1; $i <= 200; $i++) {
            $data[] = [
                'body' => "This is comment number {$i}",
                'url' => "https://example.com/comment{$i}",
                'commentable_id' => rand(1, 50),
                'commentable_type' => rand(0, 1) ? 'App\Models\Post' : 'App\Models\Video',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => rand(1, 10),
                'updated_by' => rand(1, 10),
                'is_activated' => (bool)rand(0, 1),
            ];
        }

        Comment::insert($data);
    }
}
