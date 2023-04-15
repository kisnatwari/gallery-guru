<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('description');
            $table->string('image_path');
            $table->unsignedBigInteger('views_count')->default(0);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });


        $faker = Faker::create();

        $initial_data = [
            [
                'image_path' => 'images/default_1.jpg',
                'title' => $faker->text(30),
                'description' => $faker->paragraph,
                'user_id' => 2,
                'views_count' => 0,
            ],
            [
                'image_path' => 'images/default_2.jpg',
                'title' => $faker->text(30),
                'description' => $faker->paragraph,
                'user_id' => 2,
                'views_count' => 0,
            ],
            [
                'image_path' => 'images/default_3.jpg',
                'title' => $faker->text(30),
                'description' => $faker->paragraph,
                'user_id' => 2,
                'views_count' => 0,
            ],
            [
                'image_path' => 'images/default_4.jpg',
                'title' => $faker->text(30),
                'description' => $faker->paragraph,
                'user_id' => 2,
                'views_count' => 0,
            ],
            [
                'image_path' => 'images/default_5.jpg',
                'title' => $faker->text(30),
                'description' => $faker->paragraph,
                'user_id' => 2,
                'views_count' => 0,
            ],
            [
                'image_path' => 'images/default_6.jpg',
                'title' => $faker->text(30),
                'description' => $faker->paragraph,
                'user_id' => 2,
                'views_count' => 0,
            ],
            [
                'image_path' => 'images/default_7.jpg',
                'title' => $faker->text(30),
                'description' => $faker->paragraph,
                'user_id' => 2,
                'views_count' => 0,
            ],
            [
                'image_path' => 'images/default_8.jpg',
                'title' => $faker->text(30),
                'description' => $faker->paragraph,
                'user_id' => 2,
                'views_count' => 0,
            ],
        ];

        foreach ($initial_data as $data) {
            Post::create($data);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
