<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'customerId'          => $this->id,
            'customerCode'        => $this->code,
            'customerName'        => $this->name,
            'customerBirthDate'   => $this->birth_date,
            'customerAddress'     => $this->address,
            'customerCity'        => $this->city,
            'customerNoHandphone' => $this->no_handphone,
            'customerEmail'       => $this->email,
            'customerCreatedAt'   => $this->created_at,
            'customerUpdatedAt'   => $this->updated_at,
            'totalReceipts'       => $this->customer_receipts_count
        ];
    }
}
