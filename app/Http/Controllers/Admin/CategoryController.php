<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::query()
                ->paginate(request('perPage'), ['*'], 'page', request('page'));

                
    }
    
    public function store(Request $request)
    {
        Category::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        return response()->json(['success' => 'Category added successfully']);

    }

    public function update(Request $request, Category $category)
    {
        $category->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        return response()->json(['success' => 'Category updated successfully']);
    }

    public function destory(Category $Category)
    {
        $Category->delete();
        return response()->json(['success' => 'Category deleted successfully']);
    }
}