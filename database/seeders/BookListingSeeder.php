<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookListing;
use Faker\Factory as Faker;

class BookListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            BookListing::create([
                'user_id' => 1, // You can replace this with a dynamic or valid user ID
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph(4),
                'type' => $faker->randomElement(['fiction', 'non-fiction', 'educational', 'comic', 'magazine']),
                'price' => $faker->randomFloat(2, 5, 100),
                'image' => $faker->imageUrl(),
                'approved' => $faker->boolean(),
            ]);
        }
    }
}
