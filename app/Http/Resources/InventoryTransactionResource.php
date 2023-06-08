<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryTransactionResource extends JsonResource
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
            'quantity' => $this->quantity,
            'invoiceItem' => InvoiceItemResource::make($this->whenLoaded('invoiceItem')),
            'inventory' => InventoryResource::make($this->whenLoaded('inventory')),
        ];
    }
}
