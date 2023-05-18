<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return Supplier::query()
                ->get();
                
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'gender' => 'required',
            'phone' => 'nullable|unique:suppliers,phone,',
            'address' => 'nullable|max:255',
            'description' => 'nullable|max:255',
            'status' => 'required',
        ]);
        
        Supplier::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
        ]);
        return response()->json(['success' => 'Supplier added successfully']);

    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|max:100',
            'gender' => 'required',
            'phone' => 'nullable|unique:suppliers,phone,' .$supplier->id,
            'address' => 'nullable|max:255',
            'description' => 'nullable|max:255',
            'status' => 'required',
        ]);
        $supplier->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        return response()->json(['success' => 'Supplier updated successfully']);
    }

    public function destory(Supplier $supplier)
    {
        $supplier->delete();
        return response()->json(['success' => 'Supplier deleted successfully']);
    }
}