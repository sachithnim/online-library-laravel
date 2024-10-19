<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookListing>
 */
class BookListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomElement([1,2]),
            'title' => fake()->sentence(10),
            'description' => fake()->paragraph(12),
            'type' => fake()->randomElement(['hardcover', 'paperback', 'ebook']),
            'price' => fake()->randomFloat(2, 0, 100),
            'image' => fake()->imageUrl(),
            'approved' => 1,
        ];
    }
}
