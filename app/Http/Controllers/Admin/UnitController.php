<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Requests\UnitRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;

class UnitController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        try {
            $units = Unit::latest()
                ->paginate(request('perPage'), ['*'], 'page', request('page'));

            return $this->responseSuccess($units, 'success');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }
    }

    public function store(UnitRequest $request)
    {
        $validated = $request->validated();
        try {
            $units = Unit::create([
                'name' => $validated['name'],
                'status' => $validated['status'],
            ]);
            return $this->responseSuccess($units, 'Unit created successfully');
            
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }
    }

    public function update(UnitRequest $request, Unit $unit)
    {
        $validated = $request->validated();
        try {
            $unit->update([
                'name' => $validated['name'],
                'status' => $validated['status'],
            ]);
            return $this->responseSuccess($unit, 'Unit updated successfully');
            
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }
    }

    public function destory(Unit $unit)
    {
        try {
            $unit->delete();
            return $this->responseSuccess($unit, 'Unit deleted successfully');

        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }
    }

    public function search(SearchRequest $request){
        $validated = $request->validated();
        
        try {
            $units = Unit::where(function ($query) use ($validated) {
                            $query->where('name', 'like', "%{$validated['search']}%");
                        })
                        ->paginate($validated['perPage'] ?? 10, ['*'], 'page', $validated['page'] ?? 1);
                        
            return $this->responseSuccess($units, 'Units found');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }                  
    }
}