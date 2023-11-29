<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HabitUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('habit_units')->insert([[
            'name' => 'reps',
        ],[
            'name' => 'sets',
        ],[
            'name' => 'times',
        ],[
            'name' => 'seconds',
        ],[
            'name' => 'minutes',
        ],[
            'name' => 'hours',
        ],[
            'name' => 'meters',
        ],[
            'name' => 'kilometers',
        ],[
            'name' => 'miles',
        ]]);
    }
}
