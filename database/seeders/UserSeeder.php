<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 全データを削除
        User::query()->delete();

        // 新しいユーザーの作成
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'allergy_info' => 'Peanuts',
            'preference_info' => 'Vegan'
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'allergy_info' => 'None',
            'preference_info' => 'Vegetarian'
        ]);
    }
}
