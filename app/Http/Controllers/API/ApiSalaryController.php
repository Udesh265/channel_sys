<?php

namespace App\Http\Controllers\API;

use App\Appointment;
use App\ChannelingCharges;
use App\Doctor;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Schedule;
use App\VisitingDoctorSalary;
use Carbon\Carbon;
use Illuminate\Config\Repository;
use Illuminate\Http\Request;

class ApiSalaryController extends Controller
{
    // for get employee id via search value

    public function get_doc_salary($search_value){

        $data = Employee::where('nic',$search_value)->orwhere('mobile',$search_value)->orwhere('barcode',$search_value)->first();

        $emp_id = $data->id;

        // return $emp_id;

        $doc_data = Doctor::where('employee_id',$emp_id)->first();


        return response()->json($doc_data,200);

    }

    public function get_channel_charge(){

        $data = ChannelingCharges::first();

        return response()->json($data,200);


    }
    public function get_doc_app_count($search_value){

        $data = Employee::where('nic',$search_value)->orwhere('mobile',$search_value)->orwhere('barcode',$search_value)->first();

        $emp_id = $data->id;

        // return $emp_id;
        $date = Carbon::today()->format('Y-m-d ');

        $schedule_data = Schedule::where('employee_id',$emp_id)->whereDate('startDate', Carbon::today())->first();

        $s_id = $schedule_data->id;

        // return $s_id

        $app_count = Appointment::whereDate('created_at', Carbon::today())->where('schedule_id',$s_id)->count();

        return response()->json($app_count,200);
    }

    public function get_doc_data($search_value){

        $doc_data = Employee::where('nic',$search_value)->orwhere('mobile',$search_value)->orwhere('barcode',$search_value)->first();

        $doc_name = $doc_data->first_name;

        // return $doc_name;
        return response()->json($doc_name,200);


    }
    public function save_salary(Request $request){

        $data = VisitingDoctorSalary::create([
            'employee_id' => $request->emp_id,
            'amount' => $request->doc_salary,
            'status' => 'paid',
        ]);

        if(is_null($data)) return response()->json(['msg'=>'not saved'],400);

        return response()->json(['msg'=>'Payment Successfull'],200);


    }
}
