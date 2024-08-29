<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SpoonacularService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('SPOONACULAR_API_KEY');
    }

    /**
     * レシピの栄養情報を取得します。
     *
     * @param int $recipeId
     * @return array
     */
    public function getNutritionalInfo($recipeId)
    {
        $response = Http::get("https://api.spoonacular.com/recipes/{$recipeId}/nutritionWidget.json", [
            'apiKey' => $this->apiKey,
        ]);

        $data = $response->json();

        return [
            'calories' => $data['calories'] ?? 0,
            'protein' => $this->extractNutrient($data['protein'] ?? '0g'),
            'fat' => $this->extractNutrient($data['fat'] ?? '0g'),
            'carbohydrates' => $this->extractNutrient($data['carbs'] ?? '0g'),
            'vitamins' => $this->extractVitamins($data['good'] ?? []),
            'minerals' => $this->extractMinerals($data['good'] ?? []),
        ];
    }

    /**
     * レシピを検索します。
     *
     * @param string $query
     * @return array
     */
    public function searchRecipes($query)
    {
        $response = Http::get("https://api.spoonacular.com/recipes/complexSearch", [
            'apiKey' => $this->apiKey,
            'query' => $query,
            'number' => 20, // 検索結果の数を指定
        ]);

        return $response->json();
    }

    /**
     * レシピの詳細情報を取得します。
     *
     * @param int $recipeId
     * @return array
     */
    public function getRecipeDetails($recipeId)
    {
        $response = Http::get("https://api.spoonacular.com/recipes/{$recipeId}/information", [
            'apiKey' => $this->apiKey,
        ]);

        return $response->json();
    }

    /**
     * 食材の栄養情報を取得します。
     *
     * @param array $ingredients
     * @return array
     */
    public function getCombinedNutritionalInfo(array $ingredients)
    {
        $nutritionalInfo = [];

        foreach ($ingredients as $ingredient) {
            // 食材を検索し、そのレシピの栄養情報を取得する
            $searchResponse = $this->searchRecipes($ingredient['name']);

            if (isset($searchResponse['results'][0])) {
                $recipeId = $searchResponse['results'][0]['id'];
                $nutritionalInfo[] = $this->getNutritionalInfo($recipeId);
            }
        }

        // 栄養情報の合算処理
        return $this->combineNutritionalInfo($nutritionalInfo);
    }

    /**
     * 栄養情報を合算します。
     *
     * @param array $nutritionalInfos
     * @return array
     */
    private function combineNutritionalInfo($nutritionalInfos)
    {
        // 合算処理の初期化
        $combined = [
            'calories' => 0,
            'protein' => 0,
            'fat' => 0,
            'carbohydrates' => 0,
            'vitamins' => 0,
            'minerals' => 0,
        ];

        foreach ($nutritionalInfos as $info) {
            $combined['calories'] += isset($info['calories']) && is_numeric($info['calories']) ? (float) $info['calories'] : 0;
            $combined['protein'] += isset($info['protein']) && is_numeric($info['protein']) ? (float) $info['protein'] : 0;
            $combined['fat'] += isset($info['fat']) && is_numeric($info['fat']) ? (float) $info['fat'] : 0;
            $combined['carbohydrates'] += isset($info['carbohydrates']) && is_numeric($info['carbohydrates']) ? (float) $info['carbohydrates'] : 0;
            $combined['vitamins'] += isset($info['vitamins']) && is_numeric($info['vitamins']) ? (float) $info['vitamins'] : 0;
            $combined['minerals'] += isset($info['minerals']) && is_numeric($info['minerals']) ? (float) $info['minerals'] : 0;
        }

        return $combined;
    }

    /**
     * 文字列から数値を抽出します（例: "12g" -> 12）。
     *
     * @param string $nutrient
     * @return float
     */
    private function extractNutrient($nutrient)
    {
        return (float) filter_var($nutrient, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    /**
     * ビタミン情報を抽出します。
     *
     * @param array $good
     * @return float
     */
    private function extractVitamins($good)
    {
        $vitamins = 0;
        foreach ($good as $nutrient) {
            if (strpos($nutrient['title'], 'Vitamin') !== false) {
                $vitamins += isset($nutrient['amount']) && is_numeric($nutrient['amount']) ? (float) $nutrient['amount'] : 0;
            }
        }
        return $vitamins;
    }

    /**
     * ミネラル情報を抽出します。
     *
     * @param array $good
     * @return float
     */
    private function extractMinerals($good)
    {
        $minerals = 0;
        foreach ($good as $nutrient) {
            if (in_array($nutrient['title'], ['Calcium', 'Iron', 'Magnesium', 'Potassium', 'Zinc'])) {
                $minerals += isset($nutrient['amount']) && is_numeric($nutrient['amount']) ? (float) $nutrient['amount'] : 0;
            }
        }
        return $minerals;
    }
}
