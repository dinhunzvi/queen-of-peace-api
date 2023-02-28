<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return $this->isMethod( 'POST' ) ? $this->store() : $this->update();

    }

    public function store()
    {
        return [
            'patient_id'        => 'required|exists:patients,id',
            'appointment_date'  => 'required|date',
            'bp_reading'        => 'required|numeric',
            'temperature'       => 'required',
            'sugar_levels'      => 'required'
        ];

    }

    public function update()
    {
        return [
            'patient_id'        => 'required|exists:patients,id',
            'appointment_date'  => 'required|date',
            'bp_reading'        => 'required|numeric',
            'temperature'       => 'required',
            'sugar_levels'      => 'required'
        ];

    }

}
