<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'incidents' => IncidentResource::collection($this->whenLoaded('incidents')),
            'contacts' => ContactResource::collection($this->whenLoaded('contacts')),
            'payments' => PaymentResource::collection($this->whenLoaded('payments')),
        ];
    }
}
