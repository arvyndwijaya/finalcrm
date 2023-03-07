<?php

namespace App\Http\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\TrxHSalesOrder;
use App\Models\TrxDSalesOrder;
use App\Helpers\UniqueCodeHelper;
use App\Exceptions\CustomException;
use App\Http\Resources\SalesOrderResource;

class SalesOrderService
{
    public function index($request)
    {
        try
        {
            $salesOrders = TrxHSalesOrder::withSum('salesOrderDetail', 'material_price')
                ->withSum('salesOrderDetail', 'qty')
                ->search($request->query('search'))
            ->get();

            return SalesOrderResource::collection($salesOrders);
        }
        catch (\Throwable $th)
        {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try
        {
            $salesOrder = TrxHSalesOrder::withSum('salesOrderDetail', 'material_price')
                ->withSum('salesOrderDetail', 'qty')
            ->findOrFail($id);
            
            return response()->json([
                'status' => true,
                'data'   => new SalesOrderResource($salesOrder)
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('Sales order not found');
        }
        catch (\Throwable $th)
        {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}