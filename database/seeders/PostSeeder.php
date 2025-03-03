<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Get only active authors and categories
        $activeAuthors = Author::where('Status', 1)->pluck('id')->toArray();
        $activeCategories = Category::where('Status', 1)->pluck('id')->toArray();


        // Generate posts with active authors and categories
        for($i=1;$i<=10;$i++) { // You can adjust the range for the number of posts you want to create
            $post = Post::create([
                'Title' => $faker->sentence,
                'Description' => $faker->paragraph,
                'Summary' => $faker->text(100),
                'Status' => $faker->randomElement([1, 0]), // Random active/inactive status
                'image' => $faker->imageUrl(640, 480, 'business', true),
            ]);

            // Sync the categories (select random active categories)
            $post->categories()->sync($faker->randomElements($activeCategories, $faker->numberBetween(1, 10)));

            // Sync the authors (select random active authors)
            $post->authors()->sync($faker->randomElements($activeAuthors, $faker->numberBetween(1, 10)));
        }
    }
}
