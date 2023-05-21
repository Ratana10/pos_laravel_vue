<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\SaleDetail;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::query()->where('status', 1)->get();
        $categories = Category::query()->where('status', 1)->get();

        return response()->json(['products' => $products, 
                                'categories' => $categories]);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            // create sale
            $sale = new Sale;
            $sale->code = "S001";
            $sale->customer_id = $request->customer_id;
            $sale->total = $request->total;
            $sale->due_amount = $request->due_amount;
            $sale->paid_amount = $request->paid_amount;
            // $sale->exchange = $request->exchange;
            $sale->exchange = 0;
            $sale->created_by = $request->created_by;
            $sale->date = $request->date;
            $sale->save();

            // create saledetail
            $cart = $request->saleDetail;
            foreach ($cart as $item) {
                $sale_detail = new SaleDetail;
                $sale_detail->sale_id = $sale->id;
                $sale_detail->product_id = $item['product_id'];
                $sale_detail->price = $item['price'];
                $sale_detail->quantity = $item['quantity'];
                $sale_detail->discount = $item['discount'];
                $sale_detail->save();
                
                // decrease product quantity
                Product::where('id', $item['product_id'])->decrement('quantity', $item['quantity']);
                
            }

            // create payment
            $payment = new Payment;
            $payment->sale_id = $sale->id;
            $payment->amount = $request->amount;
            $payment->payment_method = $request->payment_method;
            $payment->date = $request->date;
            $payment->created_by = $request->created_by;
            $payment->save();
            
        });
        return response()->json(['message' => 'order create successfully']);
    }
}