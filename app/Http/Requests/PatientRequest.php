<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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

    public function store(): array
    {
        return [
            'name'      => 'required|string',
            'email'     => 'required|email|unique:patients,email',
            'dob'       => 'required|date',
            'address'   => 'required'

        ];
    }

    public function update(): array
    {
        return [
            'name'      => 'required|string',
            'email'     => 'required|email|unique:patients,email,' . $this->patient->id,
            'dob'       => 'required|date',
            'address'   => 'required'

        ];
    }

}
