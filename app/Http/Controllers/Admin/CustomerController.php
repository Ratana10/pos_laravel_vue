<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
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
                    ->paginate(request('perpage') ?? 10, ['*'], 'page', request('page') ?? 1);
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
            Customer::create($validated);
            $this->responseSuccess([], 'Customer created successfully');
        } catch (\Exception $ex) {
            $this->responseError([], $ex->getMessage());
        }
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'gender' => 'required',
            'phone' => 'nullable|unique:customers,phone,'. $customer->id,
            'address' => 'nullable|max:255',
            'description' => 'nullable|max:255',
        ]);

        try {
            $customer->update($validated);
            $this->responseSuccess([], 'Customer updated successfully');
        } catch (\Exception  $ex) {
            $this->responseError([], $ex->getMessage());
        }
    }

    public function destroy(Customer $customer): JsonResponse
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