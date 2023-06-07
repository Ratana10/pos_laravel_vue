<?php

namespace App\Http\Controllers\Admin;

use App\Models\Exchange;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExchangeRequest;

class ExchangeController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $exchanges = Exchange::latest()
            ->paginate(request('perpage') ?? 10, ['*'], 'page', request('page') ?? 1);

        return $this->responseSuccess($exchanges, 'success');
      
    }
    
    public function store(ExchangeRequest $request)
    {
        $validated = $request->validated();
        try {
            $exchange = Exchange::create($validated);
            
            return $this->responseSuccess($exchange, 'Exchange created successfully');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }
    }

    public function update(ExchangeRequest $request, Exchange $exchange)
    {
        $validated = $request->validated();
        
        try {
            $exchange->update([
                'dollar' => $validated['dollar'],
                'khmer' => $validated['khmer'],
                'status' => $validated['status'],
            ]);
            
            return $this->responseSuccess($exchange, 'Exchange updated successfully');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }
    }

    public function destroy(Exchange $exchange)
    {
        try {
            $exchange->delete();
            
            return $this->responseSuccess($exchange, 'Exchange deleted successfully');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }
    }
}