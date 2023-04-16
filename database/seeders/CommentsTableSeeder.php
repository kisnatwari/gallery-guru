<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = DB::table('users')->pluck('id')->toArray();
        $posts = DB::table('posts')->pluck('id')->toArray();

        for ($i = 0; $i < 40; $i++) {
            DB::table('comments')->insert([
                'user_id' => $faker->randomElement($users),
                'post_id' => $faker->randomElement($posts),
                'comment' => $faker->sentence,
            ]);
        }
    }
}
