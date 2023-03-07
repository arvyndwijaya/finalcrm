<?php

namespace App\Http\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\MMaterial;
use App\Helpers\UniqueCodeHelper;
use App\Exceptions\CustomException;
use App\Http\Resources\MaterialResource;

class MaterialService
{
    public function index($request)
    {
        try
        {
            $materials = MMaterial::query()
                ->search($request->query('search'))
            ->get();

            return MaterialResource::collection($materials);
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
            MMaterial::insert([
                'code'       => UniqueCodeHelper::generateMaterialCode(),
                'name'       => $request->input('materialName'),
                'price'      => $request->input('materialPrice'),
                'created_at' => now()
            ]);

            return response()->json([
                'status' => true,
                'data'   => 'Material added'
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
            $material = MMaterial::findOrFail($id);

            return response()->json([
                'status' => true,
                'data'   => new MaterialResource($material)
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('Material not found');
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
            MMaterial::findOrFail($id)->update([
                'name'       => $request->input('materialName'),
                'price'      => $request->input('materialPrice'),
                'updated_at' => now()
            ]);

            return response()->json([
                'status' => true,
                'data'   => 'Material updated'
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('Material not found');
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
            MMaterial::findOrFail($id)->delete();

            return response()->json([
                'status' => true,
                'data'   => 'Material deleted'
            ]);
        }
        catch (ModelNotFoundException $th)
        {
            throw new CustomException('Material not found');
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