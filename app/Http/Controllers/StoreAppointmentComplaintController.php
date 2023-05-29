<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Complaint;
use Illuminate\Http\Request;

class StoreAppointmentComplaintController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
//        dd($request->complaints);
        $appointment = Appointment::findOrFail($request->appointment);
        $complaints = $request->complaints;

        // producing duplicates
        foreach ($complaints as $complaint_id => $complaint_level) {
            if (!is_null($complaint_level) && $complaint_level !== "0") {
//                dd($complaint_id, $complaint_level);
                $appointment->complaints()->attach($complaint_id, [
                    'level' => intval($complaint_level),
                ]);
            }
        }
    }
}
