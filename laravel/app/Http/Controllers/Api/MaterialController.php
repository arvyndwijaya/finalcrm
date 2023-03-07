<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\MaterialRequest;
use App\Http\Services\MaterialService;

class MaterialController extends Controller
{
    public function __construct(
        private MaterialService $materialService
    )
    {
        $this->materialService = $materialService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->materialService->index($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaterialRequest $request)
    {
        return $this->materialService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->materialService->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaterialRequest $request, string $id)
    {
        return $this->materialService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->materialService->destroy($id);
    }
}
