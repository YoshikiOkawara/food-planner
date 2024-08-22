<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::all();
        return view('ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        return view('ingredients.create');
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

        Ingredient::create($request->all());
        return redirect()->route('ingredients.index');
    }

    public function show(Ingredient $ingredient)
    {
        return view('ingredients.show', compact('ingredient'));
    }

    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', compact('ingredient'));
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
        return redirect()->route('ingredients.index');
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return redirect()->route('ingredients.index');
    }
}
