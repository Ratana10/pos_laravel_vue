<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Repositories\CustomerRepository;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    use ResponseTrait;
    
    private $customerRepository;
    
    public function __construct(CustomerRepository $customerRepository){
        $this->customerRepository = $customerRepository;
    }
    
    public function index(): JsonResponse
    {
        try{
            return $this->responseSuccess($this->customerRepository->getAll(), 'Customer fetch successfully');
        }
        catch(\Exception $exception){
            return $this->responseError([], $exception->getMessage());
        }
    }
    
    public function store(CustomerCreateRequest $request): JsonResponse
    {
    
        try{
            return $this->responseSuccess($this->customerRepository->create($request), 'Customer create successfully');
        }
        catch(\Exception $exception){
            return $this->responseError([], $exception->getMessage());
        }

    }

    public function update(CustomerUpdateRequest $request, Customer $customer): JsonResponse
    {
        try{
            return $this->responseSuccess($this->customerRepository->update($request, $customer), 'Customer update successfully');
        }
        catch(\Exception $exception){
            return $this->responseError([], $exception->getMessage());
        }
    }

    public function destory(Customer $customer): JsonResponse
    {
        try{
            return $this->responseSuccess($this->customerRepository->destory($customer), 'Customer delete successfully');
        }
        catch(\Exception $exception){
            return $this->responseError([], $exception->getMessage());
        }
    }
}