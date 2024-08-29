<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MealPlan;
use Illuminate\Support\Facades\Auth;

class MealPlanController extends Controller
{
    public function index()
    {
        // ログインしているユーザーの食事プランを取得
        $mealPlans = MealPlan::where('user_id', Auth::id())->get();

        return view('meal_plans.index', compact('mealPlans'));
    }

    public function create()
    {
        return view('meal_plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        // 新しい食事プランを作成
        MealPlan::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('meal_plans.index')->with('success', '食事プランが保存されました');
    }

    public function show(MealPlan $mealPlan)
    {
        $this->authorize('view', $mealPlan); // ユーザーがこの食事プランを表示できるか確認

        return view('meal_plans.show', compact('mealPlan'));
    }

    public function edit(MealPlan $mealPlan)
    {
        $this->authorize('update', $mealPlan); // ユーザーがこの食事プランを編集できるか確認

        return view('meal_plans.edit', compact('mealPlan'));
    }

    public function update(Request $request, MealPlan $mealPlan)
    {
        $this->authorize('update', $mealPlan);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        // 食事プランを更新
        $mealPlan->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        return redirect()->route('meal_plans.index')->with('success', '食事プランが更新されました');
    }

    public function destroy(MealPlan $mealPlan)
    {
        $this->authorize('delete', $mealPlan);

        $mealPlan->delete();

        return redirect()->route('meal_plans.index')->with('success', '食事プランが削除されました');
    }
}
