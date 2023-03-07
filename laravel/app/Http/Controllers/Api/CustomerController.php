<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\CustomerRequest;
use App\Http\Services\CustomerService;

class CustomerController extends Controller
{
    public function __construct(
        private CustomerService $customerService
    )
    {
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
    */
    public function index(Request $request)
    {
        return $this->customerService->index($request);
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(CustomerRequest $request)
    {
        return $this->customerService->store($request);
    }

    /**
     * Display the specified resource.
    */
    public function show(string $id)
    {
        return $this->customerService->show($id);
    }

    /**
     * Update the specified resource in storage.
    */
    public function update(CustomerRequest $request, string $id)
    {
        return $this->customerService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        return $this->customerService->destroy($id);
    }
}
