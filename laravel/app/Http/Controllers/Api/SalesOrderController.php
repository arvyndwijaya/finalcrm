<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\SalesOrderRequest;
use App\Http\Services\SalesOrderService;

class SalesOrderController extends Controller
{
    public function __construct(
        private SalesOrderService $salesOrderService
    )
    {
        $this->salesOrderService = $salesOrderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->salesOrderService->index($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->salesOrderService->show($id);
    }
}
