<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return Product::query()
                ->with('category:id,name')
                ->with('unit:id,name')
                ->get();
                
    }
    
    public function store(Request $request)
    {
        $imageName = null;
        // if($request->hasFile('image')){
        //     $image = $request->file('image');
        //     $exetension = $image->getClientOriginalExtension();
        //     $imageName = time().'.'.$exetension;
        //     $image->move(public_path('uploads/products'), $imageName);
            
        // }
        
        if($request->image){
            // $imageName = time().'.'.explode('/', explode(':', substr($request->image, 0, strpos($request->image,))))
            $image_64 = $request->image;
            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
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