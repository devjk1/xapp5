<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncidentResource extends JsonResource
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
            'overseenBy' => UserResource::make($this->whenLoaded('overseenBy')),
            'createdBy' => UserResource::make($this->whenLoaded('createdBy')),
            'patient' => PatientResource::make($this->whenLoaded('patient')),
            'notes' => NoteResource::collection($this->whenLoaded('notes')),
            'appointments' => AppointmentResource::collection($this->whenLoaded('appointments')),
        ];
    }
}
