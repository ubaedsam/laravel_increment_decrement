<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            'name' => 'Second Product',
            'price' => 20.00,
            'quantity' => 100,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
