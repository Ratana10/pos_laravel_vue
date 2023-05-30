<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\SupplierCreateRequest;
use App\Http\Requests\SupplierUpdateRequest;

class SupplierController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        try {
            if (request('status')) {
                $suppliers = Supplier::where('status', 1)->latest()->get();
            }
            else{
                $suppliers = Supplier::latest()
                        ->paginate(request('perPage'), ['*'], 'page', request('page'));
            
            }
                    
            return $this->responseSuccess($suppliers, 'success');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }       
    }
    
    public function store(SupplierCreateRequest $request)
    {
        $validated = $request->validated();
        try {
            $supplier = Supplier::create([
                'name' => $validated['name'],
                'gender' =>  $validated['gender'],
                'phone' =>  $validated['phone'] ?? null,
                'address' =>  $validated['address'] ?? null,
                'description' =>  $validated['description'] ?? null,
                'status' =>  $validated['status'],
            ]);
            return $this->responseSuccess($supplier, 'Supplier create successfully');

        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }        
    }

    public function update(SupplierUpdateRequest $request, Supplier $supplier)
    {
        $validated = $request->validated();
        try {
            $supplier->update([
                'name' => $validated['name'],
                'gender' =>  $validated['gender'],
                'phone' =>  $validated['phone'] ?? null,
                'address' =>  $validated['address'] ?? null,
                'description' =>  $validated['description'] ?? null,
                'status' =>  $validated['status'],
            ]);
            return $this->responseSuccess($supplier, 'Supplier Update successfully');

        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }              
    }

    public function destory(Supplier $supplier)
    {
        try {
            $supplier->delete();
            return $this->responseSuccess($supplier, 'Suppliers delete successfully');

        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }
    }
    
    public function search(SearchRequest $request){
        $validated = $request->validated();
        
        try {
            $suppliers = Supplier::where(function ($query) use ($validated) {
                            $query->where('name', 'like', "%{$validated['search']}%")
                                ->orWhere('phone', 'like', "%{$validated['search']}%")
                                ->orWhere('description', 'like', "%{$validated['search']}%");
                        })
                        ->paginate($validated['perPage'] ?? 10, ['*'], 'page', $validated['page'] ?? 1);
                        
            return $this->responseSuccess($suppliers, 'Suppliers found');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }                  
    }
}