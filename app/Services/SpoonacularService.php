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

    public function getNutritionalInfo($recipeId)
    {
        $response = Http::get("https://api.spoonacular.com/recipes/{$recipeId}/nutritionWidget.json", [
            'apiKey' => $this->apiKey,
        ]);

        return $response->json();
    }

    public function searchRecipes($query)
    {
        $response = Http::get("https://api.spoonacular.com/recipes/complexSearch", [
            'apiKey' => $this->apiKey,
            'query' => $query,
        ]);

        return $response->json();
    }
    public function getRecipeDetails($recipeId)
    {
        $response = Http::get("https://api.spoonacular.com/recipes/{$recipeId}/information", [
            'apiKey' => $this->apiKey,
    ]);

         dd($response->json());

        return $response->json();
    }

    public function getCombinedNutritionalInfo(array $ingredients)
    {
         $response = Http::post("https://api.spoonacular.com/recipes/mealplanner/nutrition/ingredients", [
        'apiKey' => $this->apiKey,
        'ingredients' => $ingredients
    ]);

        return $response->json();
    }
}