<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Rating;
use App\Services\SpoonacularService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    protected $spoonacularService;

    public function __construct(SpoonacularService $spoonacularService)
    {
        $this->spoonacularService = $spoonacularService;
    }

    // レシピ一覧を表示
    public function index()
    {
        $recipes = Recipe::with('user')->get();
        return view('recipes.index', compact('recipes'));
    }

    // レシピ作成フォームを表示
    public function create()
    {
        return view('recipes.create');
    }

    // 新しいレシピを保存
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Recipe::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('recipes.index');
    }

    // レシピ詳細を表示
    public function show($id)
    {
        // レシピを取得（存在しない場合は404エラー）
        $recipe = Recipe::findOrFail($id);
    
        // Spoonacular API で栄養素情報を取得
        $nutritionalInfo = $this->spoonacularService->getNutritionalInfo($recipe->id);
    
        // レシピの詳細を表示するビューにデータを渡す
        return view('recipes.show', compact('recipe', 'nutritionalInfo'));
    }

    // レシピ編集フォームを表示
    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe'));
    }

    // レシピを更新
    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $recipe->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('recipes.index');
    }

    // レシピを削除
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route('recipes.index');
    }

    /**
     * レシピに対する評価を保存するメソッド
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $recipeId
     * @return \Illuminate\Http\Response
     */
    public function storeRating(Request $request, $recipeId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $userId = Auth::id();
        $ratingValue = $request->input('rating');

        $recipe = Recipe::findOrFail($recipeId);

        if ($recipe->user_id === $userId) {
            return redirect()->route('recipes.show', $recipeId)->with('error', '自分のレシピには評価を付けられません。');
        }

        $rating = Rating::where('user_id', $userId)
                        ->where('recipe_id', $recipeId)
                        ->first();

        if ($rating) {
            $recipe->rating_total -= $rating->rating;
            $rating->rating = $ratingValue;
            $rating->save();
            $recipe->rating_total += $ratingValue;
        } else {
            Rating::create([
                'user_id' => $userId,
                'recipe_id' => $recipeId,
                'rating' => $ratingValue,
            ]);
            $recipe->rating_total += $ratingValue;
            $recipe->rating_count += 1;
        }

        $recipe->rating = $recipe->rating_count > 0 ? $recipe->rating_total / $recipe->rating_count : 0;
        $recipe->save();

        return redirect()->route('recipes.show', $recipeId)->with('success', '評価が送信されました。');
    }

    // レシピ検索
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // Spoonacular API でレシピを検索し、結果を20件取得するように設定
        $response = $this->spoonacularService->searchRecipes($query, 20);
    
        $recipes = $response['results'] ?? []; // 'results' キーが存在する場合はレシピの配列を取得
    
        return view('recipes.search_results', compact('recipes'));
    }

    // レシピ詳細情報を表示
    public function details($id)
    {
        // Spoonacular API でレシピ詳細情報を取得
        $recipeDetails = $this->spoonacularService->getRecipeDetails($id);

        // レシピ詳細のビューを返す
        return view('recipes.details', [
            'recipeDetails' => $recipeDetails,
        ]);
    }
}
