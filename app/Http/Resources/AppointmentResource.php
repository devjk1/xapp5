<?php

namespace App\Http\Resources;

use App\Models\AppointmentType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'start' => $this->start,
            'end' => $this->end,
            'scheduledFor' => UserResource::make($this->whenLoaded('scheduledFor')),
            'createdBy' => UserResource::make($this->whenLoaded('createdBy')),
            'incident' => IncidentResource::make($this->whenLoaded('incident')),
            'appointmentType' => AppointmentTypeResource::make($this->whenLoaded('appointmentType')),
            'complaints' => ComplaintResource::collection($this->whenLoaded('complaints')),
            'invoices' => InvoiceResource::collection($this->whenLoaded('invoices')),
            'location' => LocationResource::make($this->whenLoaded('location')),
        ];
    }
}
