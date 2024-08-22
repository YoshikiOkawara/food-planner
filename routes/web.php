<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\IngredientUserController;
use App\Http\Controllers\DailyFoodController;
use App\Http\Controllers\FoodSearchController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\RecipeSearchController;
use App\Http\Controllers\NutritionalInfoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);
    Route::resource('recipes', RecipeController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('ingredients', IngredientController::class);

    Route::get('/stock-management', [StockController::class, 'management'])->name('stock.management');

    Route::get('/ingredient-user', [IngredientUserController::class, 'index'])->name('ingredient_user.index');
    Route::get('/ingredient-user/create', [IngredientUserController::class, 'create'])->name('ingredient_user.create');
    Route::post('/ingredient-user', [IngredientUserController::class, 'store'])->name('ingredient_user.store');
    Route::get('/ingredient-user/{user}/edit', [IngredientUserController::class, 'edit'])->name('ingredient_user.edit');
    Route::put('/ingredient-user/{user}', [IngredientUserController::class, 'update'])->name('ingredient_user.update');
    Route::delete('/ingredient-user/{user}/{ingredient}', [IngredientUserController::class, 'destroy'])->name('ingredient_user.destroy');

    Route::get('/daily-foods/create', [DailyFoodController::class, 'create'])->name('daily_foods.create');
    Route::post('/daily-foods', [DailyFoodController::class, 'store'])->name('daily_foods.store');
    Route::get('/daily-foods/show', [DailyFoodController::class, 'show'])->name('daily_foods.show');

    Route::get('/food-search', [FoodSearchController::class, 'index'])->name('food_search.index');

    Route::post('/rate-recipe', [RatingController::class, 'store'])->name('rate.recipe');
    Route::post('/recipes/{recipe}/rate', [RecipeController::class, 'storeRating'])->name('recipes.rate');
    Route::get('/recipes/{id}/details', [RecipeController::class, 'show'])->name('recipes.show');
    Route::get('/recipes/{id}/details', [RecipeController::class, 'details'])->name('recipes.details');

    Route::post('/likes', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/likes/{recipe_id}', [LikeController::class, 'destroy'])->name('likes.destroy');

    Route::get('/search', [RecipeController::class, 'search'])->name('recipes.search');
    Route::get('/search-results', [RecipeController::class, 'searchResults'])->name('recipes.search.results');

    Route::post('/nutrition/calculate', [NutritionalInfoController::class, 'calculate'])->name('nutrition.calculate');
    Route::get('/nutrition', [NutritionalInfoController::class, 'index'])->name('nutrition.index');
    Route::get('/nutrition/{id}', [NutritionalInfoController::class, 'show'])->name('nutrition.show');
    Route::get('/nutrition/{id}/edit', [NutritionalInfoController::class, 'edit'])->name('nutrition.edit');
    Route::put('/nutrition/{id}', [NutritionalInfoController::class, 'update'])->name('nutrition.update');
});

require __DIR__.'/auth.php';
