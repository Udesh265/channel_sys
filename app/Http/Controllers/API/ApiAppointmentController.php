<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Schedule;
use Illuminate\Http\Request;

class ApiAppointmentController extends Controller
{

    public function get_schedule_appointment($employee_id){

        $employee_schedules = Schedule::whereEmployeeId($employee_id)->get();

        return response()->json($employee_schedules, 200);

    }


}

