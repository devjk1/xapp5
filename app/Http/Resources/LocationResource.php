<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->zip,
            'organization' => OrganizationResource::make($this->whenLoaded('organization')),
            'appointments' => AppointmentResource::collection($this->whenLoaded('appointments')),
            'inventories' => InventoryResource::collection($this->whenLoaded('inventories')),
        ];
    }
}
