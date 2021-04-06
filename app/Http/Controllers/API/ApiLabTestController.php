<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Lab_test_appointment;
use App\LabTest;
use App\Payment;
use App\Report_type;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiLabTestController extends Controller
{

    public function add_report_type(Request $request){

        $data = Report_type::create([
            'report_type' => $request->report_type,
            'fee'=>$request->fee,
        ]);

        if(is_null($data)) return response()->json(['msg'=>'not recored'],400);

        return  response()->json(['msg'=>'recored added success'],200);

    }

    public function get_all_report_type(){
        $data = Report_type::get();

        return  response()->json($data,200);
    }

    public function update_report_type(Request $request, $id){



        $data = Report_type::find($id);

        $data->update([
            'report_type' => $request->report_type,
            'fee'=>$request->fee,
        ]);

        if(is_null($data)) return response()->json(['msg'=>'not recored'],400);

        return  response()->json(['msg'=>'updated success'],200);
    }

    public function get_report_type(){
        $data = Report_type::get();

        return response()->json($data,200);
    }

    public function submit_appointment(Request $request){
        // return $request;
        $validate_data = $request->validate(
            [
                'payment_method' => ['required'],
            ]
        );

        $r_id = $request->rtype_id;
        $fee = Report_type::where('id',$r_id)->first();
        $amount = $fee->fee;

        $data = Payment::create([
            'amount' => $amount,
            'type' => $validate_data['payment_method'],
            'payment_status' => 'Pending',
            'patient_id' => $request->patient_id,

        ]);

        if (is_null($data)) return response()->json(['msg' => 'Failed to create payment, rolling back'], 400);

        $data->id;
        $date = Carbon::parse($request->app_date)->addDay();

        $app_data = Lab_test_appointment::create([
            'date' => $date,
            'payment_id' => $data->id,
            'patient_id' => $request->patient_id,
            'user_id' => $request->user_id,
            'report_type_id' => $request->rtype_id,
            'appointment_type' => $request->appointment_type,
            'status' => $request->status,
        ]);

        if (is_null($data)) return response()->json(['msg' => 'Failed to create appointment, rolling back'], 400);

        return response()->json(['msg' => 'Successfully create appoitnment', 'data' => ['payment' => $app_data]], 200);

    }

    public function get_lab_appointment(Request $request, $patient_id){

        $data = Lab_test_appointment::where('user_id',$patient_id)->get();

        if (is_null($data)) return response()->json(['msg' => 'Failed to get list rolling back'], 400);

        foreach ($data as $app) {

            $app->report_type;
            $app->payment;
        }
        return response()->json($data, 200);
    }


}
