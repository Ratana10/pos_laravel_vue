<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use App\Models\SaleDetail;
use App\Enums\SaleStatus;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\SaleService;

class PosController extends Controller
{
    use ResponseTrait;
    private $saleService;
    
    public function __construct(SaleService $saleService){
        $this->saleService = $saleService;
    }
    public function index()
    {
        $products = Product::query()->where('status', 1)->get();
        $categories = Category::query()->where('status', 1)->get();

        return response()->json([
            'products' => $products,
            'categories' => $categories
        ]);
    }
      // if($request->paid_amount >= $request->total){
                //     $sale->status = SaleStatus::PAID;
                    
                // }else if($request->paid_amount < $request->total)
                // {
                //     $sale->status = SaleStatus::PARTIALLY_PAID;
                // }else if($request->paid_amount == 0){
                //     $sale->status = SaleStatus::UNPAID;  
                // }
    public function store(Request $request)
    {
        // try {
        //     DB::transaction(function () use ($request) {
        //         // create sale
        //         $sale = new Sale;
        //         $sale->customer_id = $request->customer_id;
        //         $sale->total = $request->total;
        //         $sale->created_by = $request->created_by;
              
        //         $sale->save();                
        //         //create payment
        //         if($request->paid_amount){
                    
        //             // create payment
        //             $payment = new Payment;
        //             $payment->sale_id = $sale->id;
        //             $payment->amount = $request->total;
        //             $payment->paid_amount = $request->paid_amount;
        //             $payment->change = $request->change;
        //             $payment->payment_method = $request->payment_method;
        //             $payment->created_by = $request->created_by;
        //             $payment->save();
        //         }

        //        // create saledetail
        //         $cart = $request->saleDetail;
        //         foreach ($cart as $item) {
        //             $sale_detail = new SaleDetail;
        //             $sale_detail->sale_id = $sale->id;
        //             $sale_detail->product_id = $item['product_id'];
        //             $sale_detail->price = $item['price'];
        //             $sale_detail->quantity = $item['quantity'];
        //             $sale_detail->discount =  $item['discount'];
        //             $sale_detail->amount =  $item['amount'];
        //             $sale_detail->save();
                        
        //             // decrease product quantity
        //             Product::where('id', $item['product_id'])->decrement('quantity', $item['quantity']);
        //         }
                
               
        //     });
        
        //     return $this->responseSuccess([],'create sale success');
            
        // } catch (\Exception $ex) {
        //     $this->responseError([], $ex->getMessage());
        // }      
        
        try {
            $this->saleService->create($request);
            return $this->responseSuccess([],'create sale success');
        } catch (\Throwable $th) {
            $this->responseError([], 'Error while creating sale');
        }
        
    }
}