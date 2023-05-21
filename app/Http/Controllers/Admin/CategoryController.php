<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    use ResponseTrait;
    
    public function index()
    {
        try {
            if(request()->has('status')){
                $categories = Category::select('id','name')
                            ->where('status', 1)->get();
            }else{
                $categories = Category::latest()               
                ->paginate(request('perPage'), ['*'], 'page', request('page'));
            }
            
            
            return $this->responseSuccess($categories, 'success');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        } 
    }
    
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();
        try {
            $category = Category::create([
                'name' => $validated['name'],
                'status' => $validated['status'],
            ]);
            
            return $this->responseSuccess($category, 'Category created successfully');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        try {
            $category->update([
                'name' => $validated['name'],
                'status' => $validated['status'],
            ]);
            
            return $this->responseSuccess($category, 'Category updated successfully');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }
    }

    public function destory(Category $category)
    {
        try {
            $category->delete();
            
            return $this->responseSuccess($category, 'Category deleted successfully');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }
    }
}