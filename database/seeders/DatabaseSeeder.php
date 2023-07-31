<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\MovieGenre;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::create([
            "name" => "Ida Bagus Dwi Putra Purnawa",
            "email" => "putrapurnawa@gmail.com",
            "username" => "putrapurnawa",
            "password" => bcrypt("password"),
            "is_admin" => 1,
        ]);

        Movie::factory(10)->create();

        // Genre::factory(5)->create();

        Genre::create([
            "name" => "action",
            "slug" => "action"
        ]);

        Genre::create([
            "name" => "drama",
            "slug" => "drama"
        ]);

        Genre::create([
            "name" => "comedy",
            "slug" => "comedy"
        ]);

        Genre::create([
            "name" => "thriller",
            "slug" => "thriller"
        ]);

        Genre::create([
            "name" => "romance",
            "slug" => "romance"
        ]);

        MovieGenre::factory(20)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
