<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            DB::table('games')->insert([
                'name' => $faker->name,
                'profile_picture' => '',
                'birth_date' => $faker->date($format = 'Y-m-d', $max = '1995-01-01'),
                'instrument' => $faker->randomElement(['ghi ta', 'dan bau', 'sao', 'ken']),
                'biography' => $faker->paragraph,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
