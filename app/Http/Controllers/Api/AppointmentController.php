<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return AppointmentResource::collection( Appointment::all() );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request): AppointmentResource
    {
        return new AppointmentResource( Appointment::create( $request->validated() ) );

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $appointment = Appointment::find( $id );

        if ( !$appointment ) {
            abort( 404, 'Appointment not found' );
        }

        return new AppointmentResource( $appointment );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, Appointment $appointment): AppointmentResource
    {
        $appointment->update( $request->validated() );

        return new AppointmentResource( $appointment );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment): Response
    {
        $appointment->delete();

        return response()->noContent();

    }

}
