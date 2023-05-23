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

        $shared = Inertia::getShared();
//        dump($shared);
        $shared['selectedPatient'] = [
            'id' => $patient->id,
            'first_name' => $patient->first_name,
            'last_name' => $patient->last_name,
        ];
//        dump($shared);
        Inertia::flushShared();
//        dump(Inertia::getShared());
        Inertia::share($shared);
//        dd(Inertia::getShared());    // shared has been set correctly, but not reflected on frontend
                                       // $page.props.selectedPatient is null on Vue side & not set in Vue Devtools
        return to_route('patients.index');
    }
}
