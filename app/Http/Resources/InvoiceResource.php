<?php

namespace App\Http\Resources;

use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'appointment' => AppointmentResource::make($this->whenLoaded('appointment')),
            'payments' => PaymentResource::collection($this->whenLoaded('payments')),
            'invoiceItems' => InvoiceItemResource::collection($this->whenLoaded('invoiceItems')),
        ];
    }
}
