<?php

namespace App\Http\Controllers\Admin;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    use ResponseTrait;
    
    public function index(){
        // return response()->json('testing');
        try{
            $sales = Sale::query()
            ->with('customer:id,name')
            ->with('user:id,name')
            ->latest()
            ->paginate(request('perPage'), ['*'], 'page', request('page'))
            ->through(fn ($sale)=>[
                'id' => $sale->id,
                'customer' => $sale->customer,
                'total' => $sale->total,
                'status' => [
                    'name' => $sale->status->name,
                    'color' => $sale->status->color(),
                ],
                'user' => $sale->user,
                'created_at' => $sale->created,
            ]);
            return $this->responseSuccess($sales,'success');
        }
        catch(\Exception $exception){
              return $this->responseError([], $exception->getMessage());
        }
    }
}