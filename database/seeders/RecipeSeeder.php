<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\User;

class RecipeSeeder extends Seeder
{
    public function run()
    {
        // ユーザーが存在するか確認し、存在しない場合は作成
        $user1 = User::where('email', 'john@example.com')->first();
        if (!$user1) {
            $user1 = User::create([
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => bcrypt('password'), // ハッシュ化されたパスワード
            ]);
        }

        $user2 = User::where('email', 'jane@example.com')->first();
        if (!$user2) {
            $user2 = User::create([
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'password' => bcrypt('password'), // ハッシュ化されたパスワード
            ]);
        }

        // レシピの作成
        Recipe::create([
            'name' => 'Vegan Pancakes',
            'description' => 'Delicious vegan pancakes made with almond milk and bananas.',
            'user_id' => $user1->id,
        ]);

        Recipe::create([
            'name' => 'Vegetarian Pizza',
            'description' => 'Tasty vegetarian pizza with a variety of fresh vegetables.',
            'user_id' => $user2->id,
        ]);
    }
}
