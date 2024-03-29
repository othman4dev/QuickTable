<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('categories')->insert([
                'category' => $faker->word(),
            ]);
        }

        // for ($i = 0; $i < 10; $i++) {
        //     $places = $faker->randomNumber(4);
        //     DB::table('events')->insert([
        //         'title' => $faker->sentence,
        //         'description' => $faker->paragraph,
        //         'location' => $faker->address,
        //         'image' => $faker->imageUrl(),
        //         'places' => $places,
        //         'spots' => $places,
        //         'date' => $faker->date(),
        //         'time' => $faker->time(),
        //         'price' => $faker->randomFloat(2, 1, 100),
        //         'category_id' => $faker->numberBetween(1, 10),
        //         'user_id' => 3,
        //     ]);
        // }
        DB::table('users')->insert([
            'firstname' => 'Othman',
            'lastname' => ' Admin',
            'email' => 'othmandevsup@gmail.com',
            'password' => bcrypt('123456789'),
            'role' => 'Admin',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);  
        DB::table('users')->insert([
            'firstname' => 'Othman',
            'lastname' => ' Owner',
            'email' => 'othman4dev@gmail.com',
            'password' => bcrypt('123456789'),
            'role' => 'Owner',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'firstname' => 'Othman',
            'lastname' => ' User',
            'email' => 'otmankharbouch813@gmail.com',
            'password' => bcrypt('123456789'),
            'role' => 'User',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
