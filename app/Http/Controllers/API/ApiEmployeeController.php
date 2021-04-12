<?php

namespace App\Http\Controllers\API;

use App\Employee;
use App\Http\Controllers\Controller;
use App\JobType;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class ApiEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::today();
        $emplist = Employee::with('job')->whereDate('updated_at', $date)->get();

        return response()->json($emplist, 200);
    }

    public function search_all_emp($keyword)
    {

        $emp = Employee::with('job')->where('first_name', 'like', '%' . $keyword . '%')->orWhere('nic', 'like', '%' . $keyword . '%')->get();

        return response()->json($emp, 200);
    }
    public function all_emp_data()
    {

        $emp = Employee::with('job')->where('status', 1)->get();
        return response()->json($emp, 200);
    }

    public function get_one_employee($id)
    {

        $emp = Employee::with('job')->find($id);

        if (is_null($emp)) {
            return response()->json(["msg", "not found"], 400);
        }
        return response()->json($emp, 200);
    }

    public function job_list()
    {

        $job = JobType::all();
        if (is_null($job)) {
            return response()->json(['msg' => 'Faild'], 400);
        }
        return response()->json($job, 200);
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
        $validate_data = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'address'=>['required'],
            'email'=>['required', 'email', 'unique:employees'],
            'nic' => ['required', 'unique:employees', 'min:10'],
            'mobile' => ['required', 'min:10'],

        ]);

        $input = $request->all();

        $temp = $request->job_id;
        $job = JobType::find($temp);
        // $employee = new Employee();
        $job_typeID = $job->id;





        $empdata = Employee::create([

            'first_name' => $validate_data['first_name'],
            'last_name' => $validate_data['last_name'],
            'address'=>$validate_data['address'],
            'email'=>$validate_data['email'],
            'nic' => $validate_data['nic'],
            'mobile' => $validate_data['mobile'],
            'status' => 1,
            'job_type_id' => $job_typeID,

        ]);


        if($input['nic']){
        //if create generate barcode
        $string = $empdata->id . $empdata->nic;
        $barcode = (int) filter_var($string, FILTER_SANITIZE_NUMBER_INT);
        $empdata->update(
            [
                'barcode' => $barcode
                ]
            );
        }

            if(is_null($empdata)) return  response()->json(['msg' => 'Something Wrong !!'], 400);
        if ($input['doc_type']) {
            //    Log::info($input);

            $empdata->doctor()->create([
                'add_speciality_id' => $input['spec_id'],
                'hospital' => $input['hospital'],
                'doc_type' => $input['doc_type'],
                'charge_pp' => $input['charge_pp']
            ]);
        }




        if (is_null($empdata)) {
            return  response()->json(['msg' => 'Something Wrong !!'], 400);
        }
        return response()->json(['msg' => 'Employee Added Success'], 200);
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
    public function update_emp(Request $request, $id)
    {

        $employee =  Employee::find($id);

        if (is_null($employee)) return response()->json(['msg' => 'Unable to locate employye'], 404);

        $employee->update($request->all());

        if (is_null($employee)) {
            return  response()->json(['msg' => 'Something Wrong !!'], 400);
        }
        return response()->json(['msg' => ' Success'], 200);
    }



    public function del_emp(Request $request, $id)
    {
        $emp = Employee::find($id);
        // $emp = update($request->where(['status' => '0']));

        $emp->update(['status' => '0']);
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
