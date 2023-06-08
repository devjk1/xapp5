<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceItemResource extends JsonResource
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
            'price' => $this->price,
            'invoice' => InvoiceResource::make($this->whenLoaded('invoice')),
            'inventoryTransactions' => InventoryTransactionResource::collection($this->whenLoaded('inventoryTransactions')),
//            'iitemable'
        ];
    }
}
