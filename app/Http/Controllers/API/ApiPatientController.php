<?php

namespace App\Http\Controllers\API;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Lab_test_appointment;
use App\Patient;
use App\Patient_biometric_data;
use App\Treatment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class ApiPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //   add patient data from requesting form to patient table
    public function add_patient(Request $request)
    {

        // data validation
        $validated_data = $request->validate(
            [
                'name' => ['required'],
                'nic' => ['required', 'min:10'],
                'email' => ['required', 'email'],
                'age' => ['digits_between:1,3'],
                'mobile' => ['min:10', 'required', 'numeric',],
                'p_type' => ['required']

            ],
            ['p_type.required' => "Patient Type field is requied"]
        );

        $patient = new Patient();

        $patient->name = $validated_data['name'];
        $patient->nic = $validated_data['nic'];
        $patient->address = $request->address;
        $patient->mobile = $validated_data['mobile'];
        $patient->email = $validated_data['email'];
        $patient->age = $validated_data['age'];
        $patient->p_type = $validated_data['p_type'];
        $patient->status = '1';

        $p = $patient->save();

        if (is_null($p)) {
            return response()->json(["msg", "error"], 400);
        }
        return response()->json(["msg", "ok"], 200);
    }

    // get all patients data

    public function get_all_patient()
    {

        $patient =  Patient::where('status', 1)->get();
        if (is_null($patient)) {
            return response()->json(["msg", "error"], 400);
        }
        return response()->json($patient, 200);
    }


// get search patient by using seach value

    public function get_by_search($search_keyword)
    {

        $patient = Patient::where('name', 'like', '%' . $search_keyword . '%')->orWhere('nic', 'like', '%' . $search_keyword . '%')->get();
        if (is_null($patient)) {
            return response()->json(["msg", "error"], 400);
        }
        return response()->json($patient, 200);
    }

//
// get search patient by using seach value

    public function get_patient_by_search($search_keyword)
    {

        $patient = Patient::where('id',$search_keyword)->orWhere('nic', 'like', '%' . $search_keyword . '%')->get();
        if (is_null($patient)) {
            return response()->json(["msg", "error"], 400);
        }
        return response()->json($patient, 200);
    }


// get search patient profle data by id

    public function get_patient_profile($id)
    {
        $patient = Patient::find($id);
        return response()->json($patient, 200);
    }


// assign patients as system user

    public function assign_user(Request $request, $id)
    {
        // return $request;
        // $input = $request->all();
        $validated_data = $request->validate(
            [
                'role_id' => ['required'],
                'username' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8', 'confirmed']
            ]
        );

        $user = User::create([
            'username' => $validated_data['username'],
            'email' => $validated_data['email'],
            'password' => $validated_data['password'],
            'is_active' => 1,
        ]);

        if (is_null($user)) return response()->json(['msg' => 'Failed to create user, rolling back'], 400);
        $role = Role::find($validated_data['role_id']);
        $user->syncRoles($role);

        $patient = Patient::find($id);
        if (is_null($patient)) return response()->json(['msg' => 'Unable to locate patient!'], 404);

        $patient->update(
            [
                'user_id' => $user->id,

            ]
        );

        if ($patient) return response()->json(['msg' => 'successfully assigned user!'], 200);

        return response()->json(['msg' => 'Failed to assign user!'], 400);
    }

    //  change the status as deatvice soft delete

    public function delete_patient($id)
    {


        $patient = Patient::find($id);
        $patient->update(['status' => '0']);

        if (is_null($patient)) {
            return response()->json(['msg' => 'error'], 400);
        }
        return response()->json(['msg' => 'success'], 200);
    }


    /* Online patient Registraion controllers */


    public function add_patient_online(Request $request)
    {

        $validated_data = $request->validate(
            [
                'name' => ['required'],
                'nic' => ['min:10'],
                'age' => ['digits_between:1,3'],
                'mobile' => ['min:10', 'required', 'numeric',],
                'email' => ['required', 'email'],
                'username' => ['required'],
                'password' => ['required', 'min:8', 'confirmed'],

                'role_id' => ['required'],


            ],
        );

        $user = User::create([
            'username' => $validated_data['username'],
            'email' => $validated_data['email'],
            'password' => $validated_data['password'],
            'is_active' => 1,
        ]);

        if (is_null($user)) return response()->json(['msg' => 'Failed to create user, rolling back'], 400);

        $role = Role::find($validated_data['role_id']);
        $user->syncRoles($role);

        $user->id;


        $patient = new Patient();

        $patient->name = $validated_data['name'];
        $patient->nic = $validated_data['nic'];
        $patient->address = $request->address;
        $patient->mobile = $validated_data['mobile'];
        $patient->email = $validated_data['email'];
        $patient->age = $validated_data['age'];
        $patient->p_type = 'online';
        $patient->status = '1';
        $patient->user_id = $user->id;

        $p = $patient->save();

        if (is_null($p)) return response()->json(['msg' => 'Failed to create patient, rolling back'], 400);

        return response()->json(["msg", "ok"], 200);
    }

//  assign patients as system user in online

    public function assign_user_online(Request $request, $id)
    {
        // return $request;
        // $input = $request->all();
        $validated_data = $request->validate(
            [
                'role_id' => ['required'],
                'username' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8', 'confirmed']
            ]
        );
// fill data to user table
        $user = User::create([
            'username' => $validated_data['username'],
            'email' => $validated_data['email'],
            'password' => $validated_data['password'],
            'is_active' => 1,
        ]);

        if (is_null($user)) return response()->json(['msg' => 'Failed to create user, rolling back'], 400);
        $role = Role::find($validated_data['role_id']);
        $user->syncRoles($role);

        $patient = Patient::find($id);
        if (is_null($patient)) return response()->json(['msg' => 'Unable to locate patient!'], 404);

        $patient->update(
            [
                'user_id' => $user->id,

            ]
        );

        if ($patient) return response()->json(['msg' => 'successfully assigned user!'], 200);

        return response()->json(['msg' => 'Failed to assign user!'], 400);
    }

    // submit_patient_biometric_data

    public function submit_patient_biometric_data(Request $request,$patient_id){

        $data = Patient_biometric_data::where('patient_id',$patient_id);

        $data->update($request->all());

        if(is_null($data)) return response()->json(['msg' => 'not save patient bio metric data!'], 400);

        return response()->json(['msg' => 'recored added suceess!'],200);

    }

    // save_biometric_data

    public function save_biometric_data(Request $request){

        $data = Patient_biometric_data::create([
            'patient_id' => $request->patient_id,
            'diseases' => $request->diseases,
            'weight' => $request->weight,
            'height' => $request->height,
            'bp' => $request->bp,
            'lp' => $request->lp,
            'others' => $request->others,
        ]);

        if(is_null($data)) return response()->json(['msg'=>'not added data'],400);

        return response()->json(['msg'=>'record added successfull'],200);
    }
    // get_biometric_data_by_patientID

    public function get_biometric_data_by_patientID($patient_id){

        $data = Patient_biometric_data::where('patient_id',$patient_id)->first();

        if(is_null($data)) return response()->json(['msg' => 'not get patient bio metric data!'], 400);

        return response()->json($data,200);
    }
    public function save_treatment_data(Request $request , $patient_id){

        // return $request;

        $date = Carbon::parse($request->date);
        $newDate = $date->subDays(2);
        // return $newDate;
        $data = Treatment::create([
            'patient_id' => $patient_id,
            'doctor_id' => $request->user_id,
            'treatment'=> $request->treatment,
            'next_treatment' => $request->next_treatment,
            'next_treatment_date' => $request->date,
            'remind_date' => $newDate,

        ]);

        if(is_null($data)) return response()->json(['msg'=>'faild to add record',400]);

        return response()->json(['msg'=>'Record added successfull',200]);

    }

    public function get_treatment_data_by_patient_id($patient_id){

        $data = Treatment::where('patient_id',$patient_id)->get();

        if(is_null($data)) return response()->json(['msg'=>'faild to get tratment data',400]);

        return response()->json($data,200);

    }

    // update_treatment_record by doctor

    public function update_treatment_record(Request $request, $treatment_id){

        $date = Carbon::parse($request->date);
        $data = Treatment::where('id',$treatment_id);


        $data->update([
            'treatment' => $request->treatment,
            'next_treatment' => $request->next_treatment,
            'next_treatment_date' => $date,
        ]);

        if(is_null($data)) return response()->json(['msg' => 'not tratment data!'], 400);

        return response()->json(['msg' => 'recored added suceess!'],200);

    }

    public function get_lab_report_data($patient_id){

        $data = Lab_test_appointment::with('documents','report_type')->where('patient_id',$patient_id)->where('status','deliver')->get();

        if(is_null($data)) return response()->json(['msg' => 'not load report data!'], 400);

        return response()->json($data,200);



    }




// Update patient data
    public function update(Request $request, $id)
    {
        $patient =  Patient::find($id);

        if (is_null($patient)) return response()->json(['msg' => 'Unable to locate patient'], 404);

        $patient->update($request->all());

        if (is_null($patient)) {
            return  response()->json(['msg' => 'Something Wrong !!'], 400);
        }
        return response()->json(['msg' => ' Success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { }
}
