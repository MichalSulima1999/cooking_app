<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MealsSeeder::class
        ]);

        DB::table('users')->insert([
            'username' => 'Michael1099',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('zaq1@WSX'),
        ]);

        DB::table('users')->insert([
            'username' => 'test',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('test'),
        ]);

        for($i = 1; $i <= 60; $i++){
            DB::table('recipes')->insert([
                'name' => Str::random(10),
                'description' => file_get_contents('http://loripsum.net/api/plaintext'),
                'cooking_time' => rand(1, 1200),
                'image_path' => 'dummy.png',
                'ingredients' => Str::random(10).'!!'.Str::random(10).'!!'.Str::random(10),
                'meal_id' => rand(1, 4),
                'user_id' => rand(1, 2),
                'created_at' => Carbon::now()
            ]);

            DB::table('ratings')->insert([
                'rating' => rand(1, 5),
                'user_id' => 1,
                'recipe_id' => $i,
            ]);

            DB::table('ratings')->insert([
                'rating' => rand(1, 5),
                'user_id' => 2,
                'recipe_id' => $i,
            ]);

            DB::table('comments')->insert([
                'comment' => file_get_contents('http://loripsum.net/api/plaintext/1'),
                'user_id' => 1,
                'recipe_id' => $i,
            ]);

            DB::table('comments')->insert([
                'comment' => file_get_contents('http://loripsum.net/api/plaintext/1'),
                'user_id' => 2,
                'recipe_id' => $i,
            ]);
        }
        
    }
}
