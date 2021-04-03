<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\LabTest;
use App\Report_type;
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


}
