<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::all();
        return response()->json($ingredients);
    }

    public function show(Ingredient $ingredient)
    {
        return response()->json($ingredient);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'calorie' => 'nullable|integer',
            'carbohydrate' => 'nullable|integer',
            'protein' => 'nullable|integer',
            'fat' => 'nullable|integer',
            'vitamin' => 'nullable|integer',
            'mineral' => 'nullable|integer',
        ]);

        $ingredient = Ingredient::create($request->all());
        return response()->json($ingredient, 201);
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'calorie' => 'nullable|integer',
            'carbohydrate' => 'nullable|integer',
            'protein' => 'nullable|integer',
            'fat' => 'nullable|integer',
            'vitamin' => 'nullable|integer',
            'mineral' => 'nullable|integer',
        ]);

        $ingredient->update($request->all());
        return response()->json($ingredient);
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return response()->json(['message' => 'Ingredient deleted successfully']);
    }
}
