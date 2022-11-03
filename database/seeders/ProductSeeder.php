<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_product')->truncate();
        DB::table('products')->truncate();
        DB::table('product_ingredient')->truncate();
        DB::table('products')->insert([ 
           ['name' => 'Burger', 'status' => 1, 'created_at' => now(), 'updated_at' => now()]
        ]);

        DB::table('product_ingredient')->insert([
            [ 'ingredient_id' => 1, 'product_id' => 1, 'amount' => 150 ],
            [ 'ingredient_id' => 2, 'product_id' => 1, 'amount' => 30 ],
            [ 'ingredient_id' => 3, 'product_id' => 1, 'amount' => 20 ]
        ]);
    }
}
