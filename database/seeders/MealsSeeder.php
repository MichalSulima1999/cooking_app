<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('meals')->delete();

        DB::table('meals')->insert([
            ['name' => 'Śniadanie'],
            ['name' => 'Obiad'],
            ['name' => 'Kolacja'],
            ['name' => 'Deser']
        ]);
    }
}
