<?php

use App\Todo;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 3; $i++) {
            Todo::create([
                'title' => $faker->sentence(4),
                'description' => $faker->sentence(20),
                'status' => true,
            ]);
        }
    }
}
