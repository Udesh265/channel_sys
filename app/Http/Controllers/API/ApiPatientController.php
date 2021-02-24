<?php

namespace App\Http\Controllers\API;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Patient;
use App\User;
use Illuminate\Http\Request;

class ApiPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_patient(Request $request)
    {

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

    public function get_all_patient()
    {

        $patient =  Patient::where('status', 1)->get();
        if (is_null($patient)) {
            return response()->json(["msg", "error"], 400);
        }
        return response()->json($patient, 200);
    }




    public function get_by_search($search_keyword)
    {

        $patient = Patient::where('name', 'like', '%' . $search_keyword . '%')->orWhere('nic', 'like', '%' . $search_keyword . '%')->get();
        if (is_null($patient)) {
            return response()->json(["msg", "error"], 400);
        }
        return response()->json($patient, 200);
    }

    public function get_patient_profile($id)
    {
        $patient = Patient::find($id);
        return response()->json($patient, 200);
    }


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
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
