<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Generate 10 fake categories
        for ($i = 0; $i < 25; $i++) {
            DB::table('categories')->insert([
                'Title' =>$faker->word ,
               'Slug' => $faker->slug,
                'Description'=>$faker->sentence,
                'Status'=>$faker->boolean,
            ]);
        }
    }
}
