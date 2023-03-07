<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Appointment;
use App\Models\Patient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return PatientResource::collection( Patient::all() );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientRequest $request): PatientResource
    {
        //return new PatientResource( Patient::create( $request->validated()) );
        $patient = auth()->user()->patients()->create([
            'name'      => ucwords( $request->name ),
            'email'     => strtolower( $request->email ),
            'dob'       => trim( $request->dob ),
            'address'   => ucwords( trim( $request->address ) )
        ]);

        return new PatientResource( $patient );

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id ): PatientResource
    {
        $patient = Patient::find( $id );

        if ( !$patient ) {
            abort( 404, $patient );
        }

        return new PatientResource( $patient );

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientRequest $request, Patient $patient): PatientResource
    {
        $patient->update( $request->validated() );

        return new PatientResource( $patient );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient): Response
    {
        Appointment::where( 'patient_id', $patient->id )
            ->delete();

        $patient->delete();

        return response()->noContent();

    }

}
