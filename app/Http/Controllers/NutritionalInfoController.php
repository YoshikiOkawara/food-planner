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

    public function create()
    {
        return view('nutrition.create');
    }

    public function store(Request $request)
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
        $ingredients = $request->input('ingredients', []); // デフォルト値を設定

        if (empty($ingredients)) {
            return redirect()->back()->with('error', '食材情報が提供されていません。');
        }

        // 栄養情報の取得
        $nutritionInfo = $this->spoonacularService->getCombinedNutritionalInfo($ingredients);

        // データベースに食事情報を保存
        $meal = new Meal();
        $meal->type = $mealType;
        $meal->ingredients = json_encode($ingredients);
        $meal->nutrition_info = json_encode($nutritionInfo);
        $meal->user_id = auth()->id(); // ユーザーIDを保存
        $meal->save();

        return redirect()->route('nutrition.show', $meal->id)->with('success', '食事情報が正常に保存されました。');
    }

    public function show($id)
    {
        $meal = Meal::findOrFail($id);
        
        // 食材情報を取得
        $ingredients = json_decode($meal->ingredients, true);
    
        // APIから栄養情報を再取得
        $nutritionInfo = $this->spoonacularService->getCombinedNutritionalInfo($ingredients);
    
        // 栄養情報が存在しない場合のエラーハンドリング
        if (is_null($nutritionInfo)) {
            return redirect()->back()->with('error', '栄養情報が見つかりません。');
        }
    
        return view('nutrition.show', [
            'meal' => $meal,
            'ingredients' => $ingredients,
            'nutritionalInfo' => $nutritionInfo
        ]);
    }

    public function edit($id)
    {
        $meal = Meal::findOrFail($id);
        $ingredients = json_decode($meal->ingredients, true);

        if (is_null($ingredients)) {
            $ingredients = [];
        }

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
        $ingredients = $request->input('ingredients', []); // デフォルト値を設定
        if (empty($ingredients)) {
            return redirect()->back()->with('error', '食材情報が提供されていません。');
        }

        $nutritionInfo = $this->spoonacularService->getCombinedNutritionalInfo($ingredients);
        $meal->nutrition_info = json_encode($nutritionInfo);
        $meal->save();

        return redirect()->route('nutrition.show', $meal->id)->with('success', '食事情報が更新されました。');
    }

    public function destroy($id)
    {
        $meal = Meal::findOrFail($id);
        $meal->delete();

        return redirect()->route('nutrition.index')->with('success', '食事プランが削除されました。');
    }

    public function calculate(Request $request)
    {
        // バリデーション
        $request->validate([
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string',
            'ingredients.*.amount' => 'required|numeric|min:1',
            'ingredients.*.unit' => 'required|string',
        ]);

        $ingredients = $request->input('ingredients');

        // 栄養情報の取得
        $nutritionInfo = $this->spoonacularService->getCombinedNutritionalInfo($ingredients);

        return view('nutrition.calculate', [
            'nutritionalInfo' => $nutritionInfo,
        ]);
    }
}
