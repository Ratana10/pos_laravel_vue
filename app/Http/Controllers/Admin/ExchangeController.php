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
        try {
            $exchanges = Exchange::latest()->get();
            
            return $this->responseSuccess($exchanges, 'success');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        } 
    }
    
    public function store(ExchangeRequest $request)
    {
        $validated = $request->validated();
        try {
            $exchange = Exchange::create([
                'dollar' => $validated['dollar'],
                'khmer' => $validated['khmer'],
                'status' => $validated['status'],
            ]);
            
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

    public function destory(Exchange $exchange)
    {
        try {
            $exchange->delete();
            
            return $this->responseSuccess($exchange, 'Exchange deleted successfully');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }
    }
}