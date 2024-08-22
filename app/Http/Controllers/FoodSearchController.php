<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodSearchController extends Controller
{
    /**
     * Show the food search page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('food_search');
    }
}
