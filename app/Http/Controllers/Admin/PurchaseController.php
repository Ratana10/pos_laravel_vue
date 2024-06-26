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
        $purchases = Purchase::query()
                    ->with('user:id,name')
                    ->latest()
                    ->paginate(request('perpage'), ['*'], 'page', request('page'))
                    ->through(function ($purchase){
                        return [
                            'id' => $purchase->id,
                            'code' => $purchase->code,
                            'date' => $purchase->date,
                            'total' => $purchase->total,
                            'status' => [
                                'name' => $purchase->status->name,
                                'color' => $purchase->status->color(),
                            ],
                            'created_by' => $purchase->user->name
                        ];
                    });
                    
        return $this->responseSuccess($purchases, 'fetch purchase successfully');
        
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
        return $this->responseSuccess([], 'created purchase successfully');

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
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return $this->responseSuccess([], 'delete purchase successfully');        
    }

    public function generateCode()
    {      
        $generatedCode = Helper::IDGenderator(Purchase::class, 'code', 4, 'PO');
        return $this->responseSuccess($generatedCode, 'success');
    }
}