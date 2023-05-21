<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        if(request()->has('page')){
            $categories = Category::query()
                            ->paginate(request('perPage') ?? 10, ['*'], 'page', request('page') ?? 1);
        }else{
            $categories = Category::where('status', 1)->get();
        }
        
        return response()->json($categories);       
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