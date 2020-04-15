<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class DataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i <= 1000; $i++) :
            DB::table('data')
                ->insert([
                    'name'  => $faker->name,
                    'price' => $faker->numberBetween(100000, 999999),
                    'bedrooms'  => $faker->numberBetween(1, 5),
                    'bathrooms' => $faker->numberBetween(1, 3),
                    'storeys'   => $faker->numberBetween(1, 3),
                    'garages'   => $faker->numberBetween(1, 3),
                    'created_at' => $faker->dateTime('now', null),
                ]);
        endfor;
    }
}
