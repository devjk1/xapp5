<?php

namespace App\Http\Controllers;

use App\Data\PatientData;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $patients = Patient::query()
            ->when($request->query('search_last_name'), function ($query, $last_name) {
                $query->searchLastName($last_name);
            })
            ->when($request->query('search_first_name'), function ($query, $first_name) {
                $query->searchFirstName($first_name);
            })
            ->orderBy('last_name')
            ->paginate(15);

        return Inertia::render('Patients/Index', [
            'patients' => $patients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Patients/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientData $data)
    {
        Patient::create($data->all());

        return to_route('patients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return to_route('patients.index');
    }
}
