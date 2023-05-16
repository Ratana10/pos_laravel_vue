<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::query()
                ->get();
                
    }
    
    public function store(Request $request)
    {
        Product::create([
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'unit_price' => $request->unit_price,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
        return response()->json(['success' => 'Product added successfully']);

    }

    public function update(Request $request, Product $Product)
    {
        $Product->update([
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'unit_price' => $request->unit_price,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
        return response()->json(['success' => 'Product updated successfully']);
    }

    public function destory(Product $Product)
    {
        $Product->delete();
        return response()->json(['success' => 'Product deleted successfully']);
    }
}