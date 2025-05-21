<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    public function run()
    {
        // // Membuat 1000 data post secara manual
        // $posts = [];
        // for ($i = 0; $i < 1000; $i++) {
        //     $posts[] = [
        //         'id' => (string) Str::orderedUuid(), // UUID manual
        //         'title' => 'Post Title ' . ($i + 1),
        //         'content' => 'This is the content for post ' . ($i + 1),
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ];
        // }

        // // Insert data ke dalam tabel posts
        // DB::table('posts')->insert($posts);

        DB::table('posts')
            ->whereNull('is_activated')
            ->update(['is_activated' => 1]);
    }
}
