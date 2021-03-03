<?php

namespace App\Http\Controllers\API;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Schedule;
use Illuminate\Http\Request;

class ApiScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function get_schedule($employee_id)
    {


        $employee_schedules = Schedule::whereEmployeeId($employee_id)->get();

        return response()->json($employee_schedules, 200);
    }


    public function get_one_schedule($id)
    {


        $data = Schedule::find($id);

        return response()->json($data, 200);
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate_data = $request->validate([
            'startDate' => ['required'],
            'employee_id' => ['required'],
            'time' => ['required']
        ]);

        $newVal = "{$validate_data['startDate']} {$validate_data['time']}";

        $schedule = Schedule::create([
            'employee_id' => $validate_data['employee_id'],
            'startDate' => $newVal,
        ]);

        if (is_null($schedule)) return response()->json(['msg' => 'Failed to create schedule!'], 400);

        $employee_schedules = Schedule::whereEmployeeId($validate_data['employee_id'])->get();

        return response()->json($employee_schedules, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data = Schedule::find($id);

         $data->delete();

         if(is_null($data)) return response()->json(['msg' => 'error'],400);

         return response()->json(['msg' => 'successfully delete']);

    }
}
