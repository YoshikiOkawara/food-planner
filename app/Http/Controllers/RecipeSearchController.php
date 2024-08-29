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

        // APIリクエストを送信し、20件のレシピを取得
        $response = Http::get($apiUrl, [
            'query' => $query,
            'apiKey' => $apiKey,
            'number' => 20, // 取得する結果の数
        ]);

        // APIリクエストが失敗した場合の処理
        if ($response->failed()) {
            return redirect()->back()->with('error', 'レシピの取得に失敗しました。もう一度お試しください。');
        }

        // レシピデータを取得し、ビューに渡す
        $recipes = $response->json()['results'];

        return view('recipes.search_results', compact('recipes'));
    }
}
