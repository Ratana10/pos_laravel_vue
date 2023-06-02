<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\SaleDetail;

class SaleDetailController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $saledetails = SaleDetail::query()
            ->when(request()->has('sale_id'), function($query){
                $query->where('sale_id', request('sale_id'));
            })
            ->latest()
            ->paginate(request('perPage') ?? 10, ['*'], 'page', request('page') ?? 1);
            
        return $this->responseSuccess($saledetails, 'success');
    }
}