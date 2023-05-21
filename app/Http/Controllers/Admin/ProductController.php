<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        return Product::query()
                ->with('category:id,name')
                ->with('unit:id,name')
                ->paginate(request('perPage'), ['*'], 'page', request('page'));

                
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'barcode' => 'nullable|string',
            'name' => 'required|string',
            'category_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'cost' => 'required|numeric',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'alert' => 'required|numeric',
            'image' => 'nullable',
            'status' => 'required',
        ]);
        
        
        $imageName = null;
        
        if($request->image){
            
            $image_64 = $request->image;
            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];  
            $replace = substr($image_64, 0, strpos($image_64, ',')+1); 
            // find substring fro replace here eg: data:image/png;base64,

            $image = str_replace($replace, '', $image_64); 

            $image = str_replace(' ', '+', $image); 

            $imageName = time().'.'.$extension;

            $path = public_path('uploads/products/' . $imageName);
            
            File::put($path, base64_decode($image));

        }
        
        Product::create([
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'cost' => $request->cost,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'alert' => $request->alert,
            'image' => $imageName,
            'status' => $request->status,
        ]);
        return response()->json(['success' => 'Product added successfully']);

    }
    public function edit(Product $product)
    {
        if($product){
            
            return response()->json(['product' => $product]);
        }else{
            return response()->json(['fail' => 'Product Not Found']);

        }
    }
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'code' => 'required|string',
            'barcode' => 'nullable|string',
            'name' => 'required|string',
            'category_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'cost' => 'required|numeric',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'alert' => 'required|numeric',
            'image' => 'nullable',
            'status' => 'required',
        ]);
        // return $request->all();
        $imageName = null;
        if($request->image){
            if($product->image != $request->image){
                $image_64 = $request->image;
                $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];  
                $replace = substr($image_64, 0, strpos($image_64, ',')+1); 
                // find substring fro replace here eg: data:image/png;base64,
                $image = str_replace($replace, '', $image_64); 
                $image = str_replace(' ', '+', $image); 
        
                if($product->image){
                    // Delete the existing image
                    $path = public_path('uploads/products/'.$product->image);
                    if(File::exists($path)){
                        File::delete($path);
                    }
                }

                $imageName = time().'.'.$extension;
                $path = public_path('uploads/products/' . $imageName);
                File::put($path, base64_decode($image));
            }else{
                $imageName = $product->image;
            }
                
        }
        
        $product->update([
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'cost' => $request->cost,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'alert' => $request->alert,
            'image' => $imageName,
            'status' => $request->status,
        ]);
        
        return response()->json(['success' => 'Product updated successfully']);
    }

    public function destory(Product $product)
    {
        if($product->image){
            // Delete the existing image
            $path = public_path('uploads/products/'.$product->image);

            if(File::exists($path)){
                
                File::delete($path);
            }
        }
        
        $product->delete();
        return response()->json(['success' => 'Product deleted successfully']);
    }

    public function generateCode(){
        
        $lastProductCode = Product::orderBy('code', 'desc')->pluck('code')->first();
        $newProductCodeNumber = intval(substr($lastProductCode, 1)) + 1;
        $newProductCode = 'P' . str_pad($newProductCodeNumber, 3, '0', STR_PAD_LEFT);

        // return $newProductCode;
        return response()->json(['generatedCode' => $newProductCode]);
    }

    public function search(SearchRequest $request){
        $validated = $request->validated();
        $products = Product::where(function ($query) use ($validated) {
                                    $query->where('name', 'like', "%{$validated['search']}%")
                                        ->orWhere('code', 'like', "%{$validated['search']}%");
                                })
                            ->with('category:id,name')
                            ->with('unit:id,name')
                            ->paginate($validated['perPage'] ?? 10, ['*'], 'page', $validated['page'] ?? 1);
                                    
        return response()->json($products);
    }
}