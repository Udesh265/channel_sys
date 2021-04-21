<?php

namespace App\Http\Controllers\API;

use App\ChannelingCharges;
use App\Http\Controllers\Controller;
use App\Patient;
use App\Payment;
use App\Service;
use App\ServiceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $validated_data = $request->validate(
            [
                'name' => ['required'],
                'age' => ['digits_between:1,3'],
                'mobile' => ['min:10', 'required', 'numeric'],
                'email' => ['required', 'email'],

            ],
        );


        $services = $request->selected_service_list;

        $patient_data = Patient::create([
            'name' => $validated_data['name'],
            'nic' => '0',
            'email' => $validated_data['email'],
            'p_type'=>'Regular',
            'address' => 'no address',
            'mobile' => $validated_data['mobile'],
            'age' => $validated_data['age'],
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
            'payment_status' => 'Pending',
            'patient_id' => $patient_id,
        ]);

        $payment_id = $payment_data->id;

        // $serviceList_data = [];

        foreach($services as $service) {
            $serviceList_data = ['service_name' => $service['name'], 'service_fee' => $service['fee'],'service_id'=>$service['id'] ,'payment_id' => $payment_id];

            $data = ServiceList::create($serviceList_data);
        }


        if (is_null($data)) return response()->json(['msg' => 'Failed to add rolling back'], 400);

        // return response()->json(['msg' => 'Payment Success'], 200);

        return response()->json($payment_id, 200);

    }

    public function service_payment_confirm($payment_id){


        $data = Payment::find($payment_id);

        $data->update([
            'payment_status' => 'Confirm',
        ]);

        if(is_null($data)){

            return response()->json(['msg'=>'faild to update payment'],400);
        }

            return response()->json(['msg'=>'Payment Successfull'],200);

   }

   public function add_channeling_charge(Request $request){

    $data = ChannelingCharges::create([
        'charge_amount' => $request->c_charge,
    ]);

    if(is_null($data)){

        return response()->json(['msg'=>'faild to add'],400);
    }

        return response()->json(['msg'=>'Add Successfull'],200);

   }

}
