<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stock;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(): void
    {
        Stock::create([
            'user_id' => 1,
            'ingredient_id' => 1,
            'quantity' => 10,
            'expiration_date' => '2024-12-31',
            'best_before_date' => '2024-12-25',
            ]);
    }
}
