<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\User;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('user', 'ingredient')->get();
        $today = now()->format('Y-m-d');
        
        return view('stocks.index', compact('stocks', 'today'));
    }

    public function create()
    {
        $users = User::all(); // 全てのユーザーを取得
        $ingredients = Ingredient::all(); // 全ての食材を取得

        return view('stocks.create', compact('users', 'ingredients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity' => 'required|integer',
            'expiration_date' => 'required|date',
            'best_before_date' => 'required|date',
        ]);

        Stock::create($request->all());

        return redirect()->route('stocks.index');
    }

    public function edit(Stock $stock)
    {
        $users = User::all();
        $ingredients = Ingredient::all();

        return view('stocks.edit', compact('stock', 'users', 'ingredients'));
    }

    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity' => 'required|integer',
            'expiration_date' => 'required|date',
            'best_before_date' => 'required|date',
        ]);

        $stock->update($request->all());

        return redirect()->route('stocks.index');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->route('stocks.index');
    }

    public function management()
    {
        $stocks = Stock::with('user', 'ingredient')->get(); // 在庫データをすべて取得
        $today = now()->format('Y-m-d'); // 今日の日付を取得

        return view('stocks.management', compact('stocks', 'today'));
    }
}
