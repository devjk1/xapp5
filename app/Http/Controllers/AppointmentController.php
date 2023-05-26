<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedPatient = $request->session()->get('selectedPatient');
        if (isset($selectedPatient)) {
            $patient = Patient::findOrFail($selectedPatient['id']);
            $appointments = $patient->through('incidents')->has('appointments')
                ->with(['scheduledFor', 'incident.patient'])
                ->orderBy('start', 'desc')
                ->get();

            return Inertia::render('Appointments/Index', [
                'appointments' => $appointments,
            ]);
        }
        // return different views if user appointments , patient appointments (query string?)
        $appointments = Appointment::with(['scheduledFor', 'incident.patient'])
            ->orderBy('start', 'desc')
            ->get();

        return Inertia::render('Appointments/Index', [
            'appointments' => $appointments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return Inertia::render('Appointments/Show', [
            'appointment' => $appointment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
