<?php

namespace App\Http\Controllers\API;

use App\Document;
use App\Http\Controllers\Controller;
use App\Lab_test_appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ApiLaboratyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_waiting_list(){

        $date = Carbon::now()->format('Y-m-d');

        $data = Lab_test_appointment::where('status','pending')->where('date',$date)->get();

        foreach($data as $d){
            $d->report_type;
            $d->patient;
            $d->payment;
        }



        return $data;
    }

    public function check_appointment($id){

        $data = Lab_test_appointment::find($id);

        $data->update([
            'status' => 'processing'
        ]);

        if(is_null($data)) return response()->json(['msg'=>'not recored'],400);

        return  response()->json(['msg'=>'updated success'],200);
    }

    public function get_processing_list(){

        $date = Carbon::now()->format('Y-m-d');

        $data = Lab_test_appointment::where('status','processing')->where('date',$date)->get();

        foreach($data as $d){
            $d->report_type;
            $d->patient;
            $d->payment;
        }



        return $data;
    }

    public function checked_processing($id){

        $data = Lab_test_appointment::find($id);

        $data->update([
            'status' => 'deliver'
        ]);

        if(is_null($data)) return response()->json(['msg'=>'not recored'],400);

        return  response()->json(['msg'=>'updated success'],200);
    }


    public function get_deliver_list(){

        $date = Carbon::now()->format('Y-m-d');

        $data = Lab_test_appointment::where('status','deliver')->where('date',$date)->get();

        foreach($data as $d){
            $d->report_type;
            $d->patient;
            $d->payment;
            $d->documents;
        }



        return $data;
    }

    public function upload_file(Request $request){


        $validated_data = $request->validate([
            'image' => ['required'],
            'lab_app_id' => ['required'],
        ]);

            $lab_test = Lab_test_appointment::find($validated_data['lab_app_id']);



            $lab_test->update([
                'status'=>'deliver',
            ]);

         // Image upload
         $has_image = $request->image[0]['file'];
         if ($has_image) {

             $name = time() . explode('.', $request->image[0]['name'])[0]  . '.' . explode('/', explode(':', substr($request->image[0]['file'], 0, strpos($request->image[0]['file'], ';')))[1])[1];

             Image::make($request->image[0]['file'])->save(storage_path('app/public/documents/') . $name);

             $lab_test->documents()->create([
                 'path' => $name
             ]);
         } else {
            return response()->json(['msg' => 'No documents provided!'], 422);
         }

         return response()->json(['msg' => 'Documents uploaded!'], 200);
    }

    public function get_report_by_ducumentable_id($id){

        $data = Document::where('documentable_id',$id)->first();

        return response()->json($data,200);

    }




}
