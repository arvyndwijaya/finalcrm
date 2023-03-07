<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerReceiptResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'customerReceiptId'            => $this->id,
            'customerReceiptCode'          => $this->code,
            'customerReceiptName'          => $this->name,
            'customerId'                   => $this->customer_id,
            'customerName'                 => $this->customer->name,
            'customerCode'                 => $this->customer->code,
            'customerReceiptSpherisRight'  => $this->spheris_right,
            'customerReceiptSpherisLeft'   => $this->spheris_left,
            'customerReceiptCylinderRight' => $this->cylinder_right,
            'customerReceiptCylinderLeft'  => $this->cylinder_left,
            'customerReceiptAdditionRight' => $this->addition_right,
            'customerReceiptAdditionLeft'  => $this->addition_left,
            'customerReceiptAxisRight'     => $this->axis_right,
            'customerReceiptAxisLeft'      => $this->axis_left,
            'customerReceiptCreatedAt'     => $this->created_at,
            'customerReceiptUpdatedAt'     => $this->updated_at,
        ];
    }
}
