<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        return Unit::query()
                ->get();
                
    }
    
    public function store(Request $request)
    {
        Unit::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        return response()->json(['success' => 'Unit added successfully']);

    }

    public function update(Request $request, Unit $unit)
    {
        $unit->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        return response()->json(['success' => 'Unit updated successfully']);
    }

    public function destory(Unit $unit)
    {
        $unit->delete();
        return response()->json(['success' => 'Unit deleted successfully']);
    }
}