<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\MCustomerReceipt;
use App\Helpers\UniqueCodeHelper;
use App\Exceptions\CustomException;
use App\Http\Resources\CustomerReceiptResource;

class CustomerReceiptService
{
    public function index($request)
    {
        try
        {
            $customerReceipts = MCustomerReceipt::with('customer')
                ->search($request->query('search'))
            ->get();

            return CustomerReceiptResource::collection($customerReceipts);
        }
        catch (\Throwable $th)
        {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function store($request)
    {
        try
        {
            MCustomerReceipt::insert([
                'code'           => UniqueCodeHelper::generateReceiptCode(),
                'name'           => $request->input('customerReceiptName'),
                'customer_id'    => $request->input('customerId'),
                'spheris_right'  => $request->input('customerReceiptSpherisRight'),
                'spheris_left'   => $request->input('customerReceiptSpherisLeft'),
                'cylinder_right' => $request->input('customerReceiptCylinderRight'),
                'cylinder_left'  => $request->input('customerReceiptCylinderLeft'),
                'addition_right' => $request->input('customerReceiptAdditionRight'),
                'addition_left'  => $request->input('customerReceiptAdditionLeft'),
                'axis_right'     => $request->input('customerReceiptAxisRight'),
                'axis_left'      => $request->input('customerReceiptAxisLeft'),
                'created_at'     => now()
            ]);

            return response()->json([
                'status' => true,
                'data'   => 'Customer receipt added'
            ]);
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
            $customerReceipt = MCustomerReceipt::findOrFail($id);

            return response()->json([
                'status' => true,
                'data'   => new CustomerReceiptResource($customerReceipt)
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('Customer receipt not found');
        }
        catch (\Throwable $th)
        {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update($request, $id)
    {
        try
        {
            MCustomerReceipt::findOrFail($id)->update([
                'name'           => $request->input('customerReceiptName'),
                'customer_id'    => $request->input('customerId'),
                'spheris_right'  => $request->input('customerReceiptSpherisRight'),
                'spheris_left'   => $request->input('customerReceiptSpherisLeft'),
                'cylinder_right' => $request->input('customerReceiptCylinderRight'),
                'cylinder_left'  => $request->input('customerReceiptCylinderLeft'),
                'addition_right' => $request->input('customerReceiptAdditionRight'),
                'addition_left'  => $request->input('customerReceiptAdditionLeft'),
                'axis_right'     => $request->input('customerReceiptAxisRight'),
                'axis_left'      => $request->input('customerReceiptAxisLeft'),
                'updated_at'     => now()
            ]);

            return response()->json([
                'status' => true,
                'data'   => 'Customer receipt updated'
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('Customer receipt not found');
        }
        catch (\Throwable $th)
        {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try
        {
            MCustomerReceipt::findOrFail($id)->delete();

            return response()->json([
                'status' => true,
                'data'   => 'Customer receipt deleted'
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('Customer receipt not found');
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