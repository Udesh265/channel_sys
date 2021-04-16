<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;

class ApiPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // submit payment to payment table , as update payment status as confirm
   public function submit_payment($pay_id){
        $data = Payment::find($pay_id);

        $data->update([
            'payment_status' => 'Confirm',
        ]);

        if(is_null($data)){

            return response()->json(['msg'=>'faild to update payment'],400);
        }

            return response()->json(['msg'=>'Payment Successfull'],200);

   }
}
