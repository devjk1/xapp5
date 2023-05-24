<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SelectPatientController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $patient = Patient::findOrFail($request->query('patient'));

        $request->session()->put('selectedPatient', [
            'id' => $patient->id,
            'first_name' => $patient->first_name,
            'last_name' => $patient->last_name,
        ]);

        return to_route('patients.index');
    }
}
