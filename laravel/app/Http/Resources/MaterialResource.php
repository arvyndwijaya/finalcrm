<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'materialId'        => $this->id,
            'materialCode'      => $this->code,
            'materialName'      => $this->name,
            'materialPrice'     => $this->price,
            'materialCreatedAt' => $this->created_at,
            'materialUpdatedAt' => $this->updated_at,
        ];
    }
}
