<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\File;
use App\Helpers\Helper;

class ProductController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        try {
            if (request()->has('status')) {
                $products = Product::where('status', 1)->latest()->get();
            } else {
                $products = Product::latest()
                    ->with('category:id,name')
                    ->with('unit:id,name')
                    ->paginate(request('perPage'), ['*'], 'page', request('page'));
            }

            return $this->responseSuccess($products, 'success');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }
    }

    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        $imageName = null;
        try {
            if ($validated['image']) {
                $image_64 = $validated['image'];
                $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
                $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                // find substring fro replace here eg: data:image/png;base64,
    
                $image = str_replace($replace, '', $image_64);
                $image = str_replace(' ', '+', $image);
                $imageName = time() . '.' . $extension;
                $path = public_path('uploads/products/' . $imageName);
                File::put($path, base64_decode($image));
            }
                           
            $product = Product::create([
                'code' => $validated['code'],
                'name' => $validated['name'],
                'category_id' => $validated['category_id'],
                'unit_id' => $validated['unit_id'],
                'price' => $validated['price'],
                'discount' => $validated['discount'],
                'quantity' => $validated['quantity'],
                'alert' => $validated['alert'],
                'image' => $imageName,
                'status' => $validated['status'],
            ]);
            
            return $this->responseSuccess($product, 'Product created successfully');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        } 
    }
    
    public function edit(Product $product)
    {
        if($product){
            return $this->responseSuccess($product, 'Product found');
        } else{
            return $this->responseError([], 'Product not found'); 
        } 
    }
    
    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $imageName = null;
        try {
            if ($validated['image']) {
                if ($product->image != $validated['image']) {
                    $image_64 = $validated['image'];
                    $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
                    $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
                    // find substring fro replace here eg: data:image/png;base64,
                    $image = str_replace($replace, '', $image_64);
                    $image = str_replace(' ', '+', $image);
    
                    if ($product->image) {
                        // Delete the existing image
                        $path = public_path('uploads/products/' . $product->image);
                        if (File::exists($path)) {
                            File::delete($path);
                        }
                    }
    
                    $imageName = time() . '.' . $extension;
                    $path = public_path('uploads/products/' . $imageName);
                    File::put($path, base64_decode($image));
                } else {
                    $imageName = $product->image;
                }
            }
            
            $product->update([
                'code' => $validated['code'],
                'name' => $validated['name'],
                'category_id' => $validated['category_id'],
                'unit_id' => $validated['unit_id'],
                'price' => $validated['price'],
                'discount' => $validated['discount'],
                'quantity' => $validated['quantity'],
                'alert' => $validated['alert'],
                'image' => $imageName,
                'status' => $validated['status'],
            ]);
            
            return $this->responseSuccess($product, 'Product updated successfully');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }         
    }

    public function destory(Product $product)
    {
        try{
            if ($product->image) {
                // Delete the existing image
                $path = public_path('uploads/products/' . $product->image);
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
            $product->delete();
            return $this->responseSuccess($product, 'Product deleted successfully');

        }catch(\Exception $ex){
            return $this->responseError([], $ex->getMessage());
            
        }
        

    }

    public function generateCode()
    {

        // $lastProductCode = Product::orderBy('code', 'desc')->pluck('code')->first();
        // $newProductCodeNumber = intval(substr($lastProductCode, 1)) + 1;
        // $newProductCode = 'P' . str_pad($newProductCodeNumber, 3, '0', STR_PAD_LEFT);

        // // return $newProductCode;
        // return response()->json(['generatedCode' => $newProductCode]);
        
        $generatedCode = Helper::IDGenderator(Product::class, 'code', 4, 'P');
        return $this->responseSuccess($generatedCode, 'success');
        
    }

    public function search(SearchRequest $request)
    {
        $validated = $request->validated();
        $products = Product::where(function ($query) use ($validated) {
            $query->where('name', 'like', "%{$validated['search']}%")
                ->orWhere('code', 'like', "%{$validated['search']}%");
        })
            ->orWhereHas('category', function ($query) use ($validated) {
                $query->where('name', 'like', "%{$validated['search']}%");
            })
            ->with('category:id,name')
            ->with('unit:id,name')
            ->paginate($validated['perPage'] ?? 10, ['*'], 'page', $validated['page'] ?? 1);

        return response()->json($products);
    }
}