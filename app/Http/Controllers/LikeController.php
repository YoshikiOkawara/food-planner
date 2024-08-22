<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // レシピに「いいね」を追加
    public function store(Request $request)
    {
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
        ]);

        // すでに「いいね」しているか確認
        $existingLike = Like::where('user_id', Auth::id())
                            ->where('recipe_id', $request->recipe_id)
                            ->first();

        if ($existingLike) {
            return response()->json(['success' => false, 'message' => 'Already liked.']);
        }

        $like = Like::create([
            'user_id' => Auth::id(),
            'recipe_id' => $request->recipe_id,
        ]);

        return response()->json(['success' => true, 'like' => $like]);
    }

    // レシピから「いいね」を削除
    public function destroy($recipe_id)
    {
        $like = Like::where('user_id', Auth::id())
                    ->where('recipe_id', $recipe_id)
                    ->first();

        if ($like) {
            $like->delete();
        }

        return response()->json(['success' => true]);
    }
}
