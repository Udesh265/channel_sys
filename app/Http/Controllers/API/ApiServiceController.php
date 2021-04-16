<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Patient;
use App\Payment;
use App\Service;
use App\ServiceList;
use Illuminate\Http\Request;

class ApiServiceController extends Controller
{

    //  create service table to store service data
    public function add_service(Request $request){

        $data = Service::create([
            'name' => $request->name,
            'fee' => $request->fee,
            'status' => 'Active',
        ]);

        if (is_null($data)) return response()->json(['msg' => 'Failed to add rolling back'], 400);

        return response()->json(['msg' => 'Record added Success'], 200);


    }

    // get service list from Service table
    public function get_service_list(){
        $data = Service::all();

        return response()->json($data, 200);
    }

    //  Submit patient services via reception

    public function submit_service(Request $request){

        $services = $request->selected_service_list;

        $patient_data = Patient::create([
            'name' => $request->name,
            'nic' => '0',
            'email' => $request->email,
            'p_type'=>'Regular',
            'address' => 'no address',
            'mobile' => $request->mobile,
            'age' => $request->age,
            'user_id' => $request->user_id,
            'status' => 1,
        ]);

        $patient_id = $patient_data->id;

        $total = 0;

        foreach($services as $service) {
            $total += $service['fee'];
        }

        $payment_data = Payment::create([
            'amount' => $total,
            'type' => 'Services',
            'payment_status' => 'Confirm',
            'patient_id' => $patient_id,
        ]);

        $payment_id = $payment_data->id;

        $serviceList_data = [];

        foreach($services as $service) {
            $serviceList_data[] = ['service_name' => $service['name'], 'service_fee' => $service['fee'], 'payment_id' => $payment_id];
        }

        $data = ServiceList::insert($serviceList_data);

        if (is_null($data)) return response()->json(['msg' => 'Failed to add rolling back'], 400);

        return response()->json(['msg' => 'Payment Success'], 200);
    }
}
