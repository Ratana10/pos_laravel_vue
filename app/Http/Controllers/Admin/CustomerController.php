<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::query()
                ->latest()
                ->get();
            
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'gender' => 'required',
            'phone' => 'nullable|unique:customers,phone,',
            'address' => 'nullable|max:255',
        ]);
        
        Customer::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
        ]);
        return response()->json(['success' => 'customer added successfully']);

    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|max:100',
            'gender' => 'required',
            'phone' => 'nullable|unique:customers,phone,' .$customer->id,
            'address' => 'nullable|max:255',
        ]);
        
        $customer->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
        ]);
        return response()->json(['success' => 'customer updated successfully']);
    }

    public function destory(Customer $customer)
    {
        $customer->delete();
        return response()->json(['success' => 'customer deleted successfully']);
    }
}