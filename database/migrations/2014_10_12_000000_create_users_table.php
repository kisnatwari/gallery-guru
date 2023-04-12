<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->timestamps();
        });

        // Insert initial user data
        DB::table('users')->insert([
            [
                'name' => 'Saroj',
                'email' => 'sharma-S2@ulster.ac.uk',
                'password' => bcrypt('password1234'),
                'role' => 'user',
                'created_at' => now()
            ],
            [
                'name' => 'admin',
                'email' => 'admin@images-app.com',
                'password' => bcrypt('admin'),
                'role' => 'admin',
                'created_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
