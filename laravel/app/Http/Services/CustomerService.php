<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\MCustomer;
use App\Helpers\UniqueCodeHelper;
use App\Exceptions\CustomException;
use App\Http\Resources\CustomerResource;

class CustomerService
{
    public function index($request)
    {
        try
        {
            $customers = MCustomer::withCount(['customerReceipts'])
                ->search($request->query('search'))
            ->get();
            // ->paginate(10);

            return CustomerResource::collection($customers);
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
            $customer = MCustomer::insert([
                'code'         => UniqueCodeHelper::generateCustomerCode(),
                'name'         => $request->input('customerName'),
                'birth_date'   => $request->input('customerBirthDate'),
                'address'      => $request->input('customerAddress'),
                'city'         => $request->input('customerCity'),
                'no_handphone' => $request->input('customerNoHandphone'),
                'email'        => $request->input('customerEmail'),
                'created_at'   => now()
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Customer added'
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
            $customer = MCustomer::findOrFail($id);

            return response()->json([
                'status' => true,
                'data'   => new CustomerResource($customer)
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('Customer not found');
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
            MCustomer::findOrFail($id)->update([
                'name'         => $request->input('customerName'),
                'birth_date'   => $request->input('customerBirthDate'),
                'address'      => $request->input('customerAddress'),
                'city'         => $request->input('customerCity'),
                'no_handphone' => $request->input('customerNoHandphone'),
                'email'        => $request->input('customerEmail'),
                'updated_at'   => now()
            ]);

            return response()->json([
                'status' => true,
                'data'   => 'Customer updated'
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('Customer not found');
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
            MCustomer::findOrFail($id)->delete();

            return response()->json([
                'status' => true,
                'data'   => 'Customer deleted'
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('Customer not found');
        }
        catch (\Throwable $th)
        {
            return response()->json([
                'status'  => false,
                // 'message' => $th->getMessage()
                'message' => 'Customer Memiliki Receipts'
            ], 500);
        }
    }
}