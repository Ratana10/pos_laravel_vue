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
                ->get();
                
    }
    
    public function store(CustomerRequest $request)
    {
        Customer::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
        ]);
        return response()->json(['success' => 'customer added successfully']);

    }

    public function update(CustomerRequest $request, Customer $customer)
    {
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