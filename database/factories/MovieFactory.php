<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => fake()->sentence(),
            "slug" => fake()->slug(),
            "metascore" => mt_rand(10, 100),
            "synopsis" => fake()->paragraph(),
            "duration" => mt_rand(60, 240),
            "release_date" => now(),
        ];
    }
}
