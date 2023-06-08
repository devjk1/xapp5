<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'total' => $this->total,
            'patient' => PatientResource::make($this->whenLoaded('patient')),
            'createdBy' => UserResource::make($this->whenLoaded('createdBy')),
            'paymentType' => PaymentTypeResource::make($this->whenLoaded('paymentType')),
            'invoices' => InvoiceResource::collection($this->whenLoaded('invoices')),
        ];
    }
}
