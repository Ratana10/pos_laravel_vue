<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SaleStatus;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Sale;

class PaymentController extends Controller
{
    use ResponseTrait;
    
    public function index(){
        // return response()->json('testing');
        try{
            
            $payments = Payment::query()
            ->with('user:id,name')
            ->when(request()->has('sale_id'), function($query){
                $query->where('sale_id', request('sale_id'));
            })
            ->latest()
            ->paginate(request('perPage'), ['*'], 'page', request('page'))
            ->through(fn ($payment)=>[
                'id' => $payment->id,
                'sale_code' => $payment->sale_code,
                'amount' => $payment->amount,
                'paid_amount' => $payment->paid_amount,
                'change' => $payment->change,
                'payment_method' =>[
                    'name' => $payment->payment_method->name,
                    'color' => $payment->payment_method->color(),
                ],
                'created_by' => [
                    'id' => $payment->user->id,
                    'name' => $payment->user->name,
                ],
                'created_at' => $payment->created_at->format('Y-m-d'),
            ]);
            return $this->responseSuccess($payments,'success');
        }
        catch(\Exception $exception){
              return $this->responseError([], $exception->getMessage());
        }
    }

    public function store(PaymentRequest $request)
    {   
        $validated = $request->validated();
        try {
            $payment = Payment::create([
                'sale_code' => $validated['sale_code'],
                'sale_id' => $validated['sale_id'],
                'due_amount' => $validated['due_amount'],
                'paid_amount' => $validated['paid_amount'],
                'change' => $validated['change'],
                'amount' => $validated['paid_amount'] - $validated['change'],
                'payment_method' => $validated['payment_method'],
                'created_by' => 1,
            ]);            
            $this->checkPaymentToUpdateStatus($validated['sale_id']);
            return $this->responseSuccess($payment, 'success');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }
    }
    
    public function checkPaymentToUpdateStatus($sale_id)
    {
        $sale = Sale::find($sale_id);
        $total_paid_amount = Payment::where('sale_id', $sale_id)->sum('amount');
        
        $sale->update([
            'status' => $this->checkStatus($total_paid_amount, $sale->total),
        ]);

    }

    public function checkStatus($total_paid_amount, $total)
    {
        if($total_paid_amount >= $total){
            return SaleStatus::PAID;
         }
         else if($total_paid_amount != 0 && $total_paid_amount !=null){
            return SaleStatus::PARTIAL;
         }else{
            
            return SaleStatus::UNPAID;
         }
    }
}