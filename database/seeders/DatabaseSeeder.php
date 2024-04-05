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
            DB::table('posts')->insert([
    	        'title' => $faker->sentence(),
                'description' => $faker->paragraph(),
                'image' => '../uploads/defaultpost.jpg',
                'deleted' => $faker->boolean(),
                'business_id' => 1,
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            DB::table('business')->insert([
                'name' => $faker->company(),
                'business_type' => 'Restaurant',
                'address' => $faker->address(),
                'phone' => $faker->phoneNumber(),
                'email' => $faker->email(),
                'description' => $faker->paragraph(),
                'background_image' => '../uploads/defaultbusiness.jpg',
                'status' => $faker->boolean(),
                'created_at' => $faker->dateTime(),
                'owner_id' => 2,
            ]);
        }
        for ($i = 0; $i < 20; $i++) {
            DB::table('menu')->insert([
                'name' => $faker->sentence(),
                'description' => $faker->paragraph(),
                'image' => '../uploads/defaultmenu.jpg',
                'price' => $faker->numberBetween(10, 100),
                'business_id' => '1',
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }
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
