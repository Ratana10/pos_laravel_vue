<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exchange;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    public function index()
    {
        return Exchange::query()
                ->get();
                
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'dollar' => 'required|numeric',
            'khmer' => 'required|numeric',
            'status' => 'required|',
        ]);
        
        Exchange::create([
            'dollar' => $request->dollar,
            'khmer' => $request->khmer,
            'status' => $request->status,
        ]);
        return response()->json(['success' => 'Exchange added successfully']);

    }

    public function update(Request $request, Exchange $exchange)
    {
        $request->validate([
            'dollar' => 'required|numeric',
            'khmer' => 'required|numeric',
            'status' => 'required|',
        ]);
        $exchange->update([
            'dollar' => $request->dollar,
            'khmer' => $request->khmer,
            'status' => $request->status,
        ]);
        return response()->json(['success' => 'Exchange updated successfully']);
    }

    public function destory(Exchange $exchange)
    {
        $exchange->delete();
        return response()->json(['success' => 'Exchange deleted successfully']);
    }
}