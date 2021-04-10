<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
    }
}
