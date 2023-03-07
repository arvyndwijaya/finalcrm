<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesOrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'materialId'    => $this->id,
            'materialCode'  => $this->material_code,
            'materialName'  => $this->material_name,
            'materialPrice' => $this->material_price,
            'qty'           => $this->qty,
        ];
    }
}
