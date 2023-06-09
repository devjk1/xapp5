<?php

namespace App\Http\Resources;

trait ResourceTrait {
    protected function morphedRelationResource(string $morph): \Illuminate\Http\Resources\MissingValue|\Illuminate\Http\Resources\Json\JsonResource
    {
        $morphable = $this->whenLoaded($morph);

        return match ($morph) {
            'contactable' => match ($morphable::class) {
                \App\Models\Patient::class => PatientResource::make($morphable),
                \App\Models\User::class => UserResource::make($morphable),
                default => new \Illuminate\Http\Resources\MissingValue(),
            }
        };
    }
}
