<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->successResponse(
            CustomerResource::collection(Customer::latest('created_at')->get())
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCustomerRequest $request
     */
    public function store(StoreCustomerRequest $request)
    {
        $customerDto = $request->all();
        $customer = Customer::create($customerDto);
        return $this->successResponse(new CustomerResource($customer));
    }

    /**
     * Display the specified resource.
     * @param integer $id
     */
    public function show(int $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return $this->errorResponse('Customer not found', 404);
        }

        return $this->successResponse(new CustomerResource($customer));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCustomerRequest $request
     * @param number $id customer id
     */
    public function update(UpdateCustomerRequest $request, int $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return $this->errorResponse('Customer not found', 404);
        }

        $customer->update($request->all());

        return $this->successResponse(new CustomerResource($customer));
    }


    /**
     * Remove the specified resource from storage.
     * @param integer $id
     */
    public function destroy(int $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return $this->errorResponse('Customer not found', 404);
        }

        $customer->delete();

        return $this->successResponse([]);
    }
}
