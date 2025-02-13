<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $imageName = $faker->image(public_path('images/author'), 400, 300, 'people', true);
        // Generate 10 fake categories
        for ($i = 0; $i < 35; $i++) {
            DB::table('authors')->insert([
                'Name' =>$faker->word ,
                'Description'=>$faker->sentence,
                'Status'=>$faker->boolean,
               'image' => $imageName,
            ]);
        }
    }
}
