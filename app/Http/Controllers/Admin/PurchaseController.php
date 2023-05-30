<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\PurchaseDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;

class PurchaseController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        DB::transaction(function () use ($request) {
            $purchase = new Purchase;
            $purchase->code = $request->code;
            $purchase->date = $request->date;
            $purchase->total = $request->total;
            $purchase->status = 1;
            $purchase->created_by = 1;
            $purchase->save();

            // create purchase detail
            foreach($request->cart as $item){
                $purchaseDetail = new PurchaseDetail;
                $purchaseDetail->purchase_id = $purchase->id;
                $purchaseDetail->purchase_code = $request->code;
                $purchaseDetail->supplier_id = $item['supplier_id'];
                $purchaseDetail->product_id = $item['product_id'];
                $purchaseDetail->product_name = $item['product_name'];
                $purchaseDetail->cost = $item['cost'];
                $purchaseDetail->quantity = $item['quantity'];
                $purchaseDetail->unit_id = $item['unit_id'];
                $purchaseDetail->discount = $item['discount'];
                $purchaseDetail->amount = $item['amount'];
                $purchaseDetail->save();
                
            }
            
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function generateCode()
    {      
        $generatedCode = Helper::IDGenderator(Purchase::class, 'code', 4, 'PO');
        return $this->responseSuccess($generatedCode, 'success');
    }
}