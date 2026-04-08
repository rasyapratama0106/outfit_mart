<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // 🔥 TAMPILKAN HOME (biar rapi, sekalian pindahin dari route)
    public function index()
    {
        $products = Product::all();
        return view('home', compact('products'));
    }

    // 🔥 SEARCH BIASA (enter)
    public function search(Request $request)
    {
        $q = $request->q;

        if (!$q) {
            $products = Product::all();
        } else {
            $products = Product::where('name', 'LIKE', "%$q%")->get();
        }

        return view('home', compact('products'));
    }

    // 🔥 LIVE SEARCH (AJAX)
    public function searchLive(Request $request)
{
    $q = strtolower(trim($request->q));

    if ($q === '') {
        return response()->json([]);
    }

    $products = Product::all()->filter(function ($item) use ($q) {
        return str_contains(strtolower($item->name), $q);
    })->values()->take(5);

    return response()->json($products);
}
}