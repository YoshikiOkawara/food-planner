<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    public function run()
    {
        DB::table('ingredients')->insert([
            [
                'name' => '米 うるち米',
                'calorie' => 156,
                'carbohydrate' => 37.1,
                'protein' => 2.5,
                'fat' => 0.3,
                'vitamin' => 4.8,
                'mineral' => 106.05,
            ],
            [
                'name' => '小麦粉 薄力粉',
                'calorie' => 349,
                'carbohydrate' => 75.8,
                'protein' => 8.3,
                'fat' => 1.5,
                'vitamin' => null, 
                'mineral' => null, 
            ],
            [
                'name' => 'とうもろこし',
                'calorie' => 341,
                'carbohydrate' => 70.6,
                'protein' => 8.6,
                'fat' => 5.0,
                'vitamin' => null,
                'mineral' => null,
            ],
            [
                'name' => 'こんにゃく',
                'calorie' => 42,
                'carbohydrate' => 16.8,
                'protein' => 0.7,
                'fat' => 0.3,
                'vitamin' => null,
                'mineral' => null,
            ],
            [
                'name' => 'さつまいも',
                'calorie' => 129,
                'carbohydrate' => 33.7,
                'protein' => 0.9,
                'fat' => 0.2,
                'vitamin' => null,
                'mineral' => null,
            ],
            [
                'name' => 'さといも',
                'calorie' => 52,
                'carbohydrate' => 13.4,
                'protein' => 1.5,
                'fat' => 0.1,
                'vitamin' => null,
                'mineral' => null,
            ],
            [
                'name' => 'じゃがいも',
                'calorie' => 76,
                'carbohydrate' => 18.1,
                'protein' => 1.9,
                'fat' => 0.3,
                'vitamin' => 4.8,
                'mineral' => 106.05,
            ],
            [
                'name' => 'ながいも',
                'calorie' => 58,
                'carbohydrate' => 12.6,
                'protein' => 2.0,
                'fat' => 0.3,
                'vitamin' => null,
                'mineral' => null,
            ],
            [
                'name' => 'はるさめ',
                'calorie' => 76,
                'carbohydrate' => 86.6,
                'protein' => 0,
                'fat' => 0.2,
                'vitamin' => null,
                'mineral' => null,
            ],
            [
                'name' => '砂糖 上白糖',
                'calorie' => 391,
                'carbohydrate' => 99.3,
                'protein' => 0,
                'fat' => 0,
                'vitamin' => null,
                'mineral' => null,
            ],
            [
                'name' => 'はちみつ',
                'calorie' => 329,
                'carbohydrate' => 37.1,
                'protein' => 0.3,
                'fat' => 0,
                'vitamin' => null,
                'mineral' => null,
            ],
            [
                'name' => 'あずき',
                'calorie' => 124,
                'carbohydrate' => 25.6,
                'protein' => 8.6,
                'fat' => 0.8,
                'vitamin' => null,
                'mineral' => null,
            ],
        ]);
    }
}
