<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
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
            'orderItem' => OrderItemResource::make($this->whenLoaded('orderItem')),
            'inventoryTransactions' => InventoryTransactionResource::collection($this->whenLoaded('inventoryTransactions')),
            'location' => LocationResource::make($this->whenLoaded('location')),
        ];
    }
}
