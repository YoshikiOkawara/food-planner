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
        $stocks = Stock::all(); // すべての在庫データを取得
        $today = now()->format('Y-m-d'); // 今日の日付を取得
        return view('stocks.index', compact('stocks', 'today'));
    }

    public function create()
    {
        $users = User::all(); // 全てのユーザーを取得
        return view('stocks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'ingredient_name' => 'required|string',
            'quantity' => 'required|integer',
            'expiration_date' => 'required|date',
            'best_before_date' => 'required|date',
        ]);

        // 在庫データを作成
        Stock::create([
            'user_id' => $request->input('user_id'),
            'ingredient_name' => $request->input('ingredient_name'),
            'quantity' => $request->input('quantity'),
            'expiration_date' => $request->input('expiration_date'),
            'best_before_date' => $request->input('best_before_date'),
        ]);

        return redirect()->route('stocks.index');
    }

    public function edit(Stock $stock)
    {
        $users = User::all();
        return view('stocks.edit', compact('stock', 'users'));
    }

    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'ingredient_name' => 'required|string',
            'quantity' => 'required|integer',
            'expiration_date' => 'required|date',
            'best_before_date' => 'required|date',
        ]);

        $stock->update([
            'user_id' => $request->input('user_id'),
            'ingredient_name' => $request->input('ingredient_name'),
            'quantity' => $request->input('quantity'),
            'expiration_date' => $request->input('expiration_date'),
            'best_before_date' => $request->input('best_before_date'),
        ]);

        return redirect()->route('stocks.index');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stocks.index');
    }

    public function management()
    {
        $stocks = Stock::all(); // すべての在庫データを取得
        $today = now()->format('Y-m-d'); // 今日の日付を取得
        return view('stocks.management', compact('stocks', 'today'));
    }
}
