<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\CustomerReceiptRequest;
use App\Http\Services\CustomerReceiptService;

class CustomerReceiptController extends Controller
{
    public function __construct(
        private CustomerReceiptService $customerReceiptService
    )
    {
        $this->customerReceiptService = $customerReceiptService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->customerReceiptService->index($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerReceiptRequest $request)
    {
        return $this->customerReceiptService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->customerReceiptService->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerReceiptRequest $request, string $id)
    {
        return $this->customerReceiptService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->customerReceiptService->destroy($id);
    }
}
