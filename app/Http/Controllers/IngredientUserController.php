<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class IngredientUserController extends Controller
{
    // ユーザーのアレルギーと好みを新規作成するフォームを表示
    public function create()
    {
        $users = User::all();
        return view('ingredient_user.create', compact('users'));
    }

    // ユーザーのアレルギーと好みを新規作成
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'allergy_info' => 'nullable|string',
            'preference_info' => 'nullable|string',
        ]);

        // ユーザーを取得
        $user = User::findOrFail($validated['user_id']);

        // 既存のアレルギー情報と好みの詳細を保持しながら更新
        $user->allergy_info = $user->allergy_info
            ? $user->allergy_info . ($validated['allergy_info'] ? '; ' . $validated['allergy_info'] : '')
            : $validated['allergy_info'];
        $user->preference_info = $user->preference_info
            ? $user->preference_info . ($validated['preference_info'] ? '; ' . $validated['preference_info'] : '')
            : $validated['preference_info'];
        $user->save();

        // 保存完了後にリダイレクト
        return redirect()->route('ingredient_user.index')
                         ->with('success', 'アレルギーと好みの情報が新しく作成されました。');
    }

    // ユーザーのアレルギーと好みを編集するフォームを表示
    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        return view('ingredient_user.edit', compact('user'));
    }

    // ユーザーのアレルギーと好みを更新
    public function update(Request $request, $userId)
    {
        // バリデーション
        $validated = $request->validate([
            'allergy_info' => 'nullable|string',
            'preference_info' => 'nullable|string',
        ]);
    
        $user = User::findOrFail($userId);
    
        // フォームから送信されたデータを取得して保存
        $user->allergy_info = $validated['allergy_info'];
        $user->preference_info = $validated['preference_info'];
        $user->save();
    
        // 成功メッセージとともに一覧ページへリダイレクト
        return redirect()->route('ingredient_user.index')
                         ->with('success', 'アレルギーと好みの情報が更新されました。');
    }

    // アレルギーと好みの一覧表示
    public function index()
    {
        $ingredientUsers = User::all(); // アレルギー情報と好みの詳細を含むユーザーのリストを取得

        return view('ingredient_user.index', compact('ingredientUsers'));
    }
    
    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
    
        // 現在のログインユーザーIDと一致する場合は削除不可
        if ($user->id === auth()->id()) {
            return redirect()->route('ingredient_user.index')
                             ->with('error', '自分のアカウントは削除できません。');
        }
    
        // アレルギー情報と好みの詳細をクリア
        $user->allergy_info = null;
        $user->preference_info = null;
        $user->save();
    
        return redirect()->route('ingredient_user.index')->with('success', 'アレルギーと好みの情報が削除されました。');
    }
}