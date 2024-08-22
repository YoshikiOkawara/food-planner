<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\IngredientController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\IngredientUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// 認証されたユーザー情報を取得するためのルート
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 食材リソースのルート
Route::prefix('ingredients')->group(function () {
    Route::get('/', [IngredientController::class, 'index']); // 全ての食材を取得
    Route::get('/{id}', [IngredientController::class, 'show']); // 特定の食材を取得
    Route::post('/', [IngredientController::class, 'store']); // 新しい食材を作成
    Route::put('/{id}', [IngredientController::class, 'update']); // 食材を更新
    Route::delete('/{id}', [IngredientController::class, 'destroy']); // 食材を削除
});

// ユーザーリソースのルート
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']); // 全てのユーザーを取得
    Route::get('/{id}', [UserController::class, 'show']); // 特定のユーザーを取得
    Route::post('/', [UserController::class, 'store']); // 新しいユーザーを作成
    Route::put('/{id}', [UserController::class, 'update']); // ユーザーを更新
    Route::delete('/{id}', [UserController::class, 'destroy']); // ユーザーを削除
});

// ユーザーのアレルギーと好みのリソースルート
Route::prefix('ingredient-user')->group(function () {
    Route::get('/', [IngredientUserController::class, 'index']); // 全てのユーザーのアレルギーと好みを取得
    Route::post('/', [IngredientUserController::class, 'store']); // 新しいアレルギーと好みを作成
    Route::get('/{userId}', [IngredientUserController::class, 'edit']); // 特定のユーザーのアレルギーと好みを取得
    Route::put('/{userId}', [IngredientUserController::class, 'update']); // ユーザーのアレルギーと好みを更新
    Route::delete('/{userId}', [IngredientUserController::class, 'destroy']); // ユーザーのアレルギーと好みを削除
});
