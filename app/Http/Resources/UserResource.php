<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // modify for teams support
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'is_active' => $this->is_active,
            'profile_photo_url' => $this->profile_photo_url,
            'overseenIncidents' => IncidentResource::collection($this->whenLoaded('overseenIncidents')),
            'createdIncidents' => IncidentResource::collection($this->whenLoaded('createdIncidents')),
            'scheduledAppointments' => AppointmentResource::collection($this->whenLoaded('scheduledAppointments')),
            'createdAppointments' => AppointmentResource::collection($this->whenLoaded('createdAppointments')),
            'contacts' => ContactResource::collection($this->whenLoaded('contacts')),
            'payments' => PaymentResource::collection($this->whenLoaded('payments')),
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
        ];
    }
}
