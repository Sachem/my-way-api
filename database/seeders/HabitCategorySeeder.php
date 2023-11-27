<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HabitCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('habit_categories')->insert([
            'name' => 'Spirit',
        ],[
            'name' => 'Mind',
        ],[
            'name' => 'Body',
        ],[
            'name' => 'Addictions',
        ],[
            'name' => 'Health',
        ]);
    }
}
