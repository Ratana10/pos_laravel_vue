<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SaleStatus;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Services\SaleService;

class SaleController extends Controller
{
    use ResponseTrait;
    
    public function index(){
        // return response()->json('testing');
        try {
            $sales = Sale::query()
                ->with('customer:id,name')
                ->when(request('status'), function($query){   //filter status
                    $query->where('status', SaleStatus::from(request('status')));
                })
                ->latest()
                ->paginate(request('perPage'), ['*'], 'page', request('page'))
                ->through(function ($sale) {
                    $total_paid = $sale->payments->sum('amount');
                    return [
                        'id' => $sale->id,
                        'sale_code' =>$sale->code,
                        'customer' => $sale->customer->name,
                        'due_amount' => $sale->total,
                        'status' => [
                            'name' => $sale->status->name,
                            'color' => $sale->status->color(),
                        ],
                        'sell_by' => $sale->user->name,
                        'created_at' => $sale->created_at->format('Y-m-d'),
                        'paid_amount' => $total_paid,
                        'remain' => $sale->total-$total_paid,
                    ];
                });

            return $this->responseSuccess($sales, 'success');
        } catch (\Exception $exception) {
            return $this->responseError([], $exception->getMessage());
        }
    }

    public function getNumberOfSaleStatus(){
        try{
            // $count_all_status = Sale::count('status');
            // $count_paid_status = Sale::where('status', SaleStatus::from(1))->count();
            // $count_unpaid_status = Sale::where('status', SaleStatus::from(2))->count();
            // $count_partial_status = Sale::where('status', SaleStatus::from(3))->count();

            // $data = [
            //     'count_all_status' => $count_all_status,
            //     'count_paid_status' => $count_paid_status,
            //     'count_unpaid_status' => $count_unpaid_status,
            //     'count_partial_status' => $count_partial_status,
            // ];

            $cases = SaleStatus::cases();
            $saleStatuses = collect($cases)->map(function ($status){
                return [
                    'name' => $status->name,
                    'value' =>$status->value,
                    'color' =>$status->color(),
                    'count' => Sale::where('status', $status->value)->count()
                ];
            });
            
            return $this->responseSuccess($saleStatuses, 'success');
            
        }catch(\Exception $exception){
            return $this->responseError([], $exception->getMessage());
            
        }
    }

    
}