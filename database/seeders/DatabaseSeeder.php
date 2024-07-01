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
        DB::table('business')->insert([
            'name' => 'Litchi',
            'business_type' => 'Coffee Shop',
            'address' => 'Rue 20, Marrakech, Morocco',
            'phone' => '+212612345678',
            'email' => 'litchicafe@contact.com',
            'description' => 'The best coffee shop in the city',
            'background_image' => '../uploads/defaultbusiness.jpg',
            'base_price' => 2,
            'reports' => 0,
            'status' => 1,
            'created_at' => NOW(),
            'owner_id' => 2,
        ]);
        DB::table('business')->insert([
            'name' => 'Black Milk',
            'business_type' => 'Coffee Shop',
            'address' => 'Rue 20, Youssoufia, Morocco',
            'phone' => '+212612345678',
            'email' => 'blackmilk@contact.com',
            'description' => 'Best view for work or chat.',
            'background_image' => '../uploads/defaultbusiness.jpg',
            'base_price' => 3,
            'reports' => 0,
            'status' => 1,
            'created_at' => NOW(),
            'owner_id' => 2,
        ]);
        for ($i = 1; $i < 4; $i++) {
            DB::table('slides')->insert([
                'title' => 'Places',
                'business_id' => 1,
                'slider_index' => 1,
                'slide_index' => $i,
                'image' => '../assets/noimage.png',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
        for ($i = 1; $i < 4; $i++) {
            DB::table('slides')->insert([
                'title' => 'Dishes',
                'business_id' => 1,
                'slider_index' => 2,
                'slide_index' => $i,
                'image' => '../assets/noimage.png',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
        for ($i = 1; $i < 4; $i++) {
            DB::table('slides')->insert([
                'title' => 'Places',
                'business_id' => 2,
                'slider_index' => 1,
                'slide_index' => $i,
                'image' => '../assets/noimage.png',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
        for ($i = 1; $i < 4; $i++) {
            DB::table('slides')->insert([
                'title' => 'Dishes',
                'business_id' => 2,
                'slider_index' => 2,
                'slide_index' => $i,
                'image' => '../assets/noimage.png',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            DB::table('posts')->insert([
    	        'title' => $faker->sentence(),
                'description' => $faker->paragraph(),
                'image' => '../uploads/defaultpost.jpg',
                'deleted' => $faker->boolean(),
                'business_id' => $faker->numberBetween(1, 2),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }
        for ($i = 0; $i < 20; $i++) {
            DB::table('menu')->insert([
                'name' => $faker->word(),
                'description' => $faker->paragraph(),
                'price' => $faker->numberBetween(1, 10),
                'business_id' => '1',
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }
    }
}
