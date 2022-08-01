<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Models\\Arcticle>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->word(),
            'url' => fake()->unique()->sentence(),
            'imageUrl' => fake()->unique()->sentence(),
            'newsSite' => fake()->unique()->word(),
            'summary' => fake()->unique()->word(),
            'publishedAt' => fake()->dateTime(),
            'updatedAt' => fake()->dateTime()
        ];
    }
}
