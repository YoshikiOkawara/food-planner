<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meal;

class MealSeeder extends Seeder
{
    public function run()
    {
        // ダミーデータの作成
        Meal::create([
            'type' => '朝食',
            'ingredients' => json_encode([
                ['name' => '卵', 'amount' => 2, 'unit' => '個'],
                ['name' => 'パン', 'amount' => 1, 'unit' => '枚']
            ]),
            'nutrition_info' => json_encode([
                'calories' => 300,
                'protein' => '15g',
                'fat' => '10g',
                'carbohydrates' => '40g',
                'fiber' => '2g',
                'sugar' => '5g'
            ]),
            'user_id' => 1 // 仮のユーザーID
        ]);

        Meal::create([
            'type' => '昼食',
            'ingredients' => json_encode([
                ['name' => '鶏肉', 'amount' => 150, 'unit' => 'grams'],
                ['name' => 'サラダ', 'amount' => 1, 'unit' => '皿']
            ]),
            'nutrition_info' => json_encode([
                'calories' => 500,
                'protein' => '30g',
                'fat' => '20g',
                'carbohydrates' => '45g',
                'fiber' => '5g',
                'sugar' => '10g'
            ]),
            'user_id' => 1
        ]);

        Meal::create([
            'type' => '夕食',
            'ingredients' => json_encode([
                ['name' => '魚', 'amount' => 200, 'unit' => 'grams'],
                ['name' => 'ご飯', 'amount' => 1, 'unit' => '杯']
            ]),
            'nutrition_info' => json_encode([
                'calories' => 600,
                'protein' => '40g',
                'fat' => '25g',
                'carbohydrates' => '55g',
                'fiber' => '4g',
                'sugar' => '8g'
            ]),
            'user_id' => 1
        ]);
    }
}
