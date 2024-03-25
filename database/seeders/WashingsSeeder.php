<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class WashingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker = Faker::create();
       foreach (range(1,20) as $index){
           DB::table('washings')->insert([
               'washing_name' => $faker->word(),
               'owner_name' => $faker->word(),
               'owner_tel' => $faker->numerify('0708277242'),
               'image' => $faker->sentence(5),
               'address' => $faker->sentence(5),
           ]);
       }
    }
}
