<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::query()->where('status', 1)->get();
        $categories = Category::query()->where('status', 1)->get();

        return response()->json(array('products' => $products, 'categories' => $categories));
    }
}