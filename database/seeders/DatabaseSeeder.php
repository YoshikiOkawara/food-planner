<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 外部キー制約を無効にする
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call([
            UserSeeder::class,
            RecipeSeeder::class,
            IngredientSeeder::class,
            StockSeeder::class,
        ]);

        // 外部キー制約を再び有効にする
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
