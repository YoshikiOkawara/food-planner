<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;

class MealController extends Controller
{
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'type' => 'required|string',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string',
            'ingredients.*.amount' => 'required|numeric|min:1',
            'ingredients.*.unit' => 'required|string',
        ]);

        // 食事プランの保存
        $meal = new Meal();
        $meal->type = $request->input('type');
        $meal->ingredients = json_encode($request->input('ingredients'));
        $meal->nutrition_info = json_encode($request->input('nutrition_info'));
        $meal->user_id = auth()->id(); // ユーザーIDを保存
        $meal->save();

        return response()->json(['message' => '食事プランが正常に作成されました。', 'meal' => $meal], 201);
    }
}
