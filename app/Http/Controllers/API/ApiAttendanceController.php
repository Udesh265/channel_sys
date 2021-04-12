<?php

namespace App\Http\Controllers\API;

use App\Employee;
use App\EmployeeAttendance;
use App\Http\Controllers\Controller;
use App\TimeSetting;
use App\WorkingTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ApiAttendanceController extends Controller
{

  public function  save_time(Request $request){


    $setting_ArrivalTimeFullDay = Carbon::parse($request->setting_ArrivalTimeFullDay);
    $setting_ArrivalTimeHalfDay = Carbon::parse($request->setting_ArrivalTimeHalfDay);
    $setting_EndOfDayTime = Carbon::parse($request->setting_EndOfDayTime);

        $data = WorkingTime::create([
            'ArrivalTimeFullDay' => $setting_ArrivalTimeFullDay,
            'ArrivalTimeHalfDay' => $setting_ArrivalTimeHalfDay,
            'EndOfDayTime' => $setting_EndOfDayTime,
        ]);

        return response()->json(['msg'=> 'successfully update time settings'],200);

        // $time_data = TimeSetting::update([
        //     'variable' => $data->Arrive
        // ]);
    }



    public function mark_attendance($value, Request $request){

        $time = $request->query->get('time');
        if (!$time) return response()->json(['message' => 'Time query string is required'], 400);

        $now = Carbon::parse($time);

        $fl_dtime_f = WorkingTime::where('ArrivalTimeFullDay')->first()->addMinute();
        $fl_dtime = Carbon::parse($fl_dtime_f);
        $hf_dtime_h = WorkingTime::where('ArrivalTimeHalfDay')->first()->addMinute();
        $hf_dtime = Carbon::parse($hf_dtime_h);
        $eow_time_e = WorkingTime::where('EndOfDayTime')->first()->subMinute();
        $eow_time = Carbon::parse($eow_time_e);



        $employee = Employee::where('barcode',$value)->orWhere('nic_no', '=', $value)->first();
        if (is_null($employee)) return response()->json(['message' => 'Unable to locate employee!'], 404);

        $attendance = EmployeeAttendance::where('employee_id',$employee->id)->whereDate('date', '=', $now->copy()->toDateString())->first();
        if (is_null($attendance)) {
            //If attendance is not marked, add new attance
            $status = 'present';

            //Check if in between fullday and halfday. Then status is half day
            if ($now->between($fl_dtime, $hf_dtime)) {
                $status = "present";
            }

            //Check if after halfday. Then status is leave
            if ($now->isAfter($hf_dtime)) {
                $status = "leave";
            }

            $employee->attendance()->create([
                'in_time' => $now->copy()->toTimeString(),
                'date' => $now->copy()->toDateString(),
                'status' => $status
            ]);

            if (is_null($employee)) return response()->json(['message' => 'Failed to add attendance record!'], 400);

            return response()->json(['message' => "Attendance marked successfully!", 'employee' => $employee], 200);
        }

        $current_status = $attendance->status;
        if ($current_status == 'present' && Carbon::parse($attendance->in_time)->isBefore($fl_dtime)) {

            $status = $current_status;

            if ($now->isBefore($hf_dtime)) {
                $status = 'leave';
            }

            if ($now->isBetween($hf_dtime, $eow_time)) {
                $status = "half_day";
            }

            if ($now->isAfter($eow_time)) {
                $status = "full_day";
            }

            $attendance->status = $status;
            $attendance->out_time = $now;
            $attendance->save();
        }

        if ($current_status == 'present' && Carbon::parse($attendance->in_time)->between($fl_dtime, $hf_dtime) ) {

            $status = $current_status;

            if ($now->isBefore($eow_time)) {
                $status = 'leave';
            }else {
                $status = 'half_day';
            }

            $attendance->status = $status;
            $attendance->out_time = $now;
            $attendance->save();
        }

        if (is_null($employee)) return response()->json(['message' => 'Failed to update attendance record!'], 400);

        return response()->json(['message' => "Attendance updated successfully!", 'employee' => $employee], 200);
    }

}
