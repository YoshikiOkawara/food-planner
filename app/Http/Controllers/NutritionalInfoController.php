<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Services\SpoonacularService;
use Illuminate\Http\Request;

class NutritionalInfoController extends Controller
{
    protected $spoonacularService;

    public function __construct(SpoonacularService $spoonacularService)
    {
        $this->spoonacularService = $spoonacularService;
    }

    public function index()
    {
        $meals = Meal::all();
        return view('nutrition.index', ['meals' => $meals]);
    }

    public function calculate(Request $request)
    {
        // バリデーションの追加
        $request->validate([
            'meal_type' => 'required|string',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string',
            'ingredients.*.amount' => 'required|numeric|min:1',
            'ingredients.*.unit' => 'required|string',
        ]);

        $mealType = $request->input('meal_type');
        $ingredients = $request->input('ingredients');

        // 栄養情報の取得
        $nutritionInfo = $this->spoonacularService->getCombinedNutritionalInfo($ingredients);

        // データベースに食事情報を保存
        $meal = new Meal();
        $meal->type = $mealType;
        $meal->ingredients = json_encode($ingredients);
        $meal->nutrition_info = json_encode($nutritionInfo);
        $meal->user_id = auth()->id(); // ユーザーIDを保存
        $meal->save();

        return view('nutrition.show', ['nutritionalInfo' => $nutritionInfo]);
    }

    public function show($id)
    {
        $meal = Meal::findOrFail($id);
        $nutritionInfo = json_decode($meal->nutrition_info, true);

        return view('nutrition.show', ['nutritionalInfo' => $nutritionInfo]);
    }

    public function edit($id)
    {
        $meal = Meal::findOrFail($id);
        $ingredients = json_decode($meal->ingredients, true);

        return view('nutrition.edit', ['meal' => $meal, 'ingredients' => $ingredients]);
    }

    public function update(Request $request, $id)
    {
        // バリデーションの追加
        $request->validate([
            'meal_type' => 'required|string',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string',
            'ingredients.*.amount' => 'required|numeric|min:1',
            'ingredients.*.unit' => 'required|string',
        ]);

        $meal = Meal::findOrFail($id);
        $meal->type = $request->input('meal_type');
        $meal->ingredients = json_encode($request->input('ingredients'));

        // 栄養情報の再計算
        $nutritionInfo = $this->spoonacularService->getCombinedNutritionalInfo($request->input('ingredients'));
        $meal->nutrition_info = json_encode($nutritionInfo);
        $meal->save();

        return redirect()->route('nutrition.show', $meal->id);
    }
}
