<?php

namespace App\Http\Controllers\API;

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

        $patient = new Patient();

        $patient->name = $request->name;
        $patient->nic = $request->nic;
        $patient->address = $request->address;
        $patient->mobile = $request->mobile;
        $patient->email = $request->email;
        $patient->age = $request->age;
        $patient->p_type = $request->p_type;
        $patient->status ='1';

        $p = $patient->save();

        if (is_null($p)) {
            return response()->json(["msg", "error"], 400);
        }
        return response()->json(["msg", "ok"], 200);
    }

    public function get_all_patient(){

        $patient =  Patient::where('user_id',null)->get();
         if(is_null($patient)){
             return response()->json(["msg","error"],400);
         }
        return response()->json($patient,200);
    }

    public function assign_user(Request $request, $id)
    {
        // $input = $request->all();
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'is_active' => 1,
        ]);

        if(is_null($user)) return response()->json(['msg' => 'Failed to create user, rolling back'], 400);

        $patient = Patient::find($id);
        if(is_null($patient)) return response()->json(['msg' => 'Unable to locate patient!'],404 );

        $patient->update(
            [
                'user_id' => $user->id,

            ]
        );

        if($patient) return response()->json(['msg' => 'successfully assigned user!'], 200);

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
        //
    }
}
