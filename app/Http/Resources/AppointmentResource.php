<?php

namespace App\Http\Resources;

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
            'id'                => $this->id,
            'patient_id'        => $this->patient_id,
            'patient_name'      => $this->patient->name,
            'appointment_date'  => $this->appointment_date->format( 'Y-m-d' ),
            'bp_reading'        => $this->bp_reading,
            'temperature'       => $this->temperature,
            'sugar_levels'      => $this->sugar_levels,
            'created_at'        => $this->created_at->format( 'Y-m-d H:i:s' ),
            'updated_at'        => $this->updated_at->format( 'Y-m-d H:i:s' ),
        ];

    }

}
