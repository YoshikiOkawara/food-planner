<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        // フォームから送信されたデータを検証します
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',  // レシピIDが存在することを確認
            'rating' => 'required|integer|min:1|max:5',   // 評価が1から5の整数であることを確認
        ]);

        // トランザクションを開始
        DB::beginTransaction();

        try {
            // 現在のユーザーとレシピに基づく評価を作成または更新します
            $rating = Rating::updateOrCreate(
                [
                    'user_id' => Auth::id(),           // 現在のユーザーIDを取得
                    'recipe_id' => $request->recipe_id // レシピID
                ],
                [
                    'rating' => $request->rating       // 評価を保存
                ]
            );

            // レシピの評価情報を更新します
            $recipe = Recipe::find($request->recipe_id);
            if ($recipe) {
                // レシピに関連するすべての評価を取得し、評価の合計と回数を計算
                $ratingTotal = $recipe->ratings()->sum('rating');  // 評価の合計を計算
                $ratingCount = $recipe->ratings()->count();        // 評価回数を計算
                
                $averageRating = $ratingCount > 0 
                    ? $ratingTotal / $ratingCount 
                    : 0; // 平均評価を計算（評価がない場合は0）

                // レシピの評価情報を更新
                $recipe->update([
                    'rating_total' => $ratingTotal,
                    'rating_count' => $ratingCount,
                    'rating' => $averageRating,
                ]);
            }

            // トランザクションをコミット
            DB::commit();

            // 元のページにリダイレクトし、成功メッセージを表示します
            return redirect()->back()->with('success', '評価を保存しました');
        } catch (\Exception $e) {
            // エラーが発生した場合はトランザクションをロールバック
            DB::rollBack();

            // エラーメッセージを表示
            return redirect()->back()->with('error', '評価の保存に失敗しました。再度お試しください。');
        }
    }
}
