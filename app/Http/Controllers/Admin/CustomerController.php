<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\CustomerCreateRequest;


class CustomerController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        try {
            if (!request()->has('page')) {
                $customers = Customer::latest()
                    ->get();
            } else {
                $customers = Customer::latest()
                    ->paginate(request('perPage'), ['*'], 'page', request('page'));
            }
            return $this->responseSuccess($customers, 'success');
        } catch (\Exception $exception) {
            return $this->responseError([], $exception->getMessage());
        }
    }

    public function store(CustomerCreateRequest $request)
    {
        $validated = $request->validated();
        try {
            $customer = Customer::create([
                'name' => $validated['name'],
                'gender' =>  $validated['gender'],
                'phone' =>  $validated['phone'] ?? null,
                'address' =>  $validated['address'] ?? null,
                'description' =>  $validated['description'] ?? null,
            ]);
            $this->responseSuccess($customer, 'Customer created successfully');
        } catch (\Exception $ex) {
            $this->responseError([], $ex->getMessage());
        }
    }

    public function update(CustomerCreateRequest $request, Customer $customer)
    {
        $validated = $request->validated();

        try {
            $customer->update([
                'name' => $validated['name'],
                'gender' =>  $validated['gender'],
                'phone' =>  $validated['phone'] ?? null,
                'address' =>  $validated['address'] ?? null,
                'description' =>  $validated['description'] ?? null,
            ]);
            $this->responseSuccess($customer, 'Customer updated successfully');
        } catch (\Exception  $ex) {
            $this->responseError([], $ex->getMessage());
        }
    }

    public function destory(Customer $customer): JsonResponse
    {
        try {
            $deleted = $customer->delete();
            return $this->responseSuccess($deleted, 'Customer deleted successfully');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }
    }

    public function search(SearchRequest $request)
    {
        $validated = $request->validated();
        try {
            $customers = Customer::where(function ($query) use ($validated) {
                                $query->where('name', 'like', "%{$validated['search']}%")
                                    ->orWhere('phone', 'like', "%{$validated['search']}%");
                                })
                                ->paginate($validated['perPage'] ?? 10, ['*'], 'page', $validated['page'] ?? 1);

            return $this->responseSuccess($customers, 'success');
        } catch (\Exception $ex) {
            return $this->responseError([], $ex->getMessage());
        }
    }
}