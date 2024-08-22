<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecipeSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            return redirect()->back()->with('error', '検索語句を入力してください。');
        }

        $apiKey = env('SPOONACULAR_API_KEY');
        $apiUrl = 'https://api.spoonacular.com/recipes/complexSearch';

        $response = Http::get($apiUrl, [
            'query' => $query,
            'apiKey' => $apiKey,
            'number' => 10, // 取得する結果の数
        ]);

        if ($response->failed()) {
            return redirect()->back()->with('error', 'レシピの取得に失敗しました。もう一度お試しください。');
        }

        $recipes = $response->json()['results'];

        return view('recipes.search_results', compact('recipes'));
    }
}
