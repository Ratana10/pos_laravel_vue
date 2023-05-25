<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class SaleTestController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        try {
            $sales = Sale::query()
                // ->select('sales.id', 'sales.total', 'name as customer_name')
                ->with('customer:id,name')
                ->with('payments:sale_id,paid_amount')
                ->latest()
                ->paginate(request('perPage'), ['*'], 'page', request('page'))
                ->through(function ($sale) {
                    // $sale->load('payments');
                    $total_paid = $sale->payments->sum('paid_amount');

                    return [
                        'id' => $sale->id,
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
}