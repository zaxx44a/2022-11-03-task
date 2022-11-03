<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('ingredients')->truncate();
        \DB::table('ingredients')->insert([
            [ 
                'name' => 'Beef',
                'current' => 20000,
                'threshold' => 50,
                'full_load' => 20000,
                'unit' => 'gram',
                'created_at' => now(),
                'updated_at' => now() 
            ],[ 
                'name' => 'Cheese',
                'current' => 5000,
                'threshold' => 50,
                'full_load' => 5000,
                'unit' => 'gram',
                'created_at' => now(),
                'updated_at' => now() 
            ],[ 
                'name' => 'Onion',
                'current' => 1000,
                'threshold' => 50,
                'full_load' => 1000,
                'unit' => 'gram',
                'created_at' => now(),
                'updated_at' => now() 
            ],
        ]);
    }
}
