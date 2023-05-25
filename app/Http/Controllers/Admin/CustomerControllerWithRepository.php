<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Repositories\CustomerRepository;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    use ResponseTrait;
    
    private $customerRepository;
    
    public function __construct(CustomerRepository $customerRepository){
        $this->customerRepository = $customerRepository;
    }
    public function index(){
        try{
            if(!request()->has('page')){
                $customers = Customer::latest()
                        ->get();
            } else{
                $customers = Customer::latest()
                        ->paginate(request('perPage'), ['*'], 'page', request('page'));
            }  
            return $this->responseSuccess($customers,'success');
        }
        catch(\Exception $exception){
              return $this->responseError([], $exception->getMessage());
        }
    }

    
    // public function index(): JsonResponse
    // {
    //     try{
    //         return $this->responseSuccess($this->customerRepository->getAll(), 'Customer fetch successfully');
    //     }
    //     catch(\Exception $exception){
    //         return $this->responseError([], $exception->getMessage());
    //     }
    // }
    
    public function store(CustomerCreateRequest $request): JsonResponse
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
        } catch (\Exception $ex){
            $this->responseError([], $ex->getMessage());
        }
                 
        return response()->json($customer);
        // try{
        //     return $this->responseSuccess($this->customerRepository->create($request->validated()), 'Customer create successfully');
        // }
        // catch(\Exception $exception){
        //     return $this->responseError([], $exception->getMessage());
        // }

    }

    public function update(CustomerUpdateRequest $request, Customer $customer): JsonResponse
    {
        try{
            return $this->responseSuccess($this->customerRepository->update($request->validated(), $customer), 'Customer update successfully');
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

    public function search(SearchRequest $request){
        $validated = $request->validated();
        $products = Customer::where(function ($query) use ($validated) {
                                    $query->where('name', 'like', "%{$validated['search']}%")
                                        ->orWhere('phone', 'like', "%{$validated['search']}%");
                                })
                            ->paginate($validated['perPage'] ?? 10, ['*'], 'page', $validated['page'] ?? 1);
                                    
        return response()->json($products);
    }
}