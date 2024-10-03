<?php

namespace App\Http\Controllers;

use App\Models\DailyFood;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyFoodController extends Controller
{
    // 食品入力フォームを表示
    public function create()
    {
        $ingredients = Ingredient::all();
        return view('daily_foods.create', compact('ingredients'));
    }

    // 食品データを保存
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'amount' => 'required|numeric|min:0',
            'meal_time' => 'required|string|in:朝食,昼食,夕食,間食',
        ]);

        DailyFood::create([
            'user_id' => Auth::id(),
            'amount' => $validated['amount'],
            'meal_time' => $validated['meal_time'],
        ]);

        return redirect()->route('daily_foods.show')->with('success', '食品データが保存されました。');
    }

    // 合計を計算して表示
    public function show()
    {
        $userId = Auth::id();
        $dailyFoods = DailyFood::where('user_id', $userId)->get();

        $meals = ['朝食', '昼食', '夕食', '間食'];
        $totals = [];

        foreach ($meals as $meal) {
            $totals[$meal] = $dailyFoods->where('meal_time', $meal)->reduce(function ($carry, $dailyFood) {
                $ingredient = $dailyFood->ingredient;
                $amount = $dailyFood->amount;

                $carry['calories'] += $ingredient->calorie * $amount / 100;
                $carry['carbohydrates'] += $ingredient->carbohydrate * $amount / 100;
                $carry['protein'] += $ingredient->protein * $amount / 100;
                $carry['fat'] += $ingredient->fat * $amount / 100;

                $carry['vitamin'] += $ingredient->vitamin * $amount / 100;
                $carry['mineral'] += $ingredient->mineral * $amount / 100;

                return $carry;
            }, ['calories' => 0, 'carbohydrates' => 0, 'protein' => 0, 'fat' => 0, 'vitamin' => 0, 'mineral' => 0]);
        }

        return view('daily_foods.show', compact('totals'));
    }

    // 食品データ一覧を表示
    public function index()
    {
        $dailyFoods = DailyFood::where('user_id', Auth::id())->get();
        return view('daily_foods.index', compact('dailyFoods'));
    }

    // 食品データ編集フォームを表示
    public function edit(DailyFood $dailyFood)
    {
        $ingredients = Ingredient::all();
        return view('daily_foods.edit', compact('dailyFood', 'ingredients'));
    }

    // 食品データを更新
    public function update(Request $request, DailyFood $dailyFood)
    {
        $validated = $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'amount' => 'required|numeric|min:0',
            'meal_time' => 'required|string|in:朝食,昼食,夕食',
        ]);

        $dailyFood->update($validated);

        return redirect()->route('daily_foods.index')->with('success', '食品データが更新されました。');
    }

    // 食品データを削除
    public function destroy(DailyFood $dailyFood)
    {
        $dailyFood->delete();
        return redirect()->route('daily_foods.index')->with('success', '食品データが削除されました。');
    }
}
