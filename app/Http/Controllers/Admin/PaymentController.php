<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;


class PaymentController extends Controller
{
    use ResponseTrait;
    
    public function index(){
        // return response()->json('testing');
        try{
            
            $payments = Payment::query()
            ->with('user:id,name')
            ->latest()
            ->paginate(request('perPage'), ['*'], 'page', request('page'))
            ->through(fn ($payment)=>[
                'id' => $payment->id,
                'sale_id' => $payment->sale_id,
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
}