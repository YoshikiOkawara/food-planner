<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\IngredientUser;
use Illuminate\Http\Request;

class IngredientUserController extends Controller
{
    public function index()
    {
        $ingredientUsers = IngredientUser::all(); // 全てのデータを取得
        return response()->json($ingredientUsers);
    }

    public function show($id)
    {
        $ingredientUser = IngredientUser::find($id);

        if (!$ingredientUser) {
            return response()->json(['message' => 'IngredientUser not found'], 404);
        }

        return response()->json($ingredientUser);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'ingredient_id' => 'required|exists:ingredients,id',
            'allergy' => 'nullable|string',
            'preference' => 'nullable|string',
        ]);

        $ingredientUser = IngredientUser::create($request->all());
        return response()->json($ingredientUser, 201);
    }

    public function update(Request $request, $id)
    {
        $ingredientUser = IngredientUser::find($id);

        if (!$ingredientUser) {
            return response()->json(['message' => 'IngredientUser not found'], 404);
        }

        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'ingredient_id' => 'sometimes|exists:ingredients,id',
            'allergy' => 'nullable|string',
            'preference' => 'nullable|string',
        ]);

        $ingredientUser->update($request->all());
        return response()->json($ingredientUser);
    }

    public function destroy($id)
    {
        $ingredientUser = IngredientUser::find($id);

        if (!$ingredientUser) {
            return response()->json(['message' => 'IngredientUser not found'], 404);
        }

        $ingredientUser->delete();
        return response()->json(['message' => 'IngredientUser deleted successfully']);
    }
}
