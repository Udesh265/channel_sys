<?php

namespace App\Http\Controllers\API;

use App\Appointment;
use App\Employee;
use App\Http\Controllers\Controller;
use App\JobType;
use App\Patient;
use App\Payment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiReportController extends Controller
{

    public function get_active_emp_count(){

        $data = Employee::where('status',1)->count();

        return response()->json($data,200);
    }
    public function get_suspended_emp_count(){

        $data = Employee::where('status',0)->count();

        return response()->json($data,200);
    }
    public function get_active_user_count(){

        $data = Employee::whereIn('job_type_id', [1, 2, ])->count();

        return response()->json($data,200);
    }
    public function get_all_emp(){

        $data = Employee::get();

        foreach($data as $d){
            $d->job;
            // $d->user;
        }

        return response()->json($data,200);
    }
    public function get_job_role(){

        $data = JobType::get();

        return response()->json($data,200);
    }
    public function get_today_new_patients_count(){

        $data = Patient::where('created_at', Carbon::today())->count();

        return response()->json($data,200);

    }
    public function get_monthly_new_patients_count(){

        $data = Patient::whereMonth('created_at', Carbon::now()->month)->count();

        return response()->json($data,200);
    }

    public function get_online_patients_count(){

        $data = Patient::where('p_type','online')->count();

        return response()->json($data,200);
    }
    public function get_top_paid_patient_list(Request $request){

        // return $request;

        $from = Carbon::parse($request->t_from);
        $to = Carbon::parse($request->t_to);
        $type = $request->type;
        $status = $request->status;
        $orderby = $request->orderBy;

        $data = Payment::with('patient')->whereBetween('created_at',[$from,$to])->where('type',$type)->where('payment_status',$status)->orderBy('amount',$orderby)->get();

        if(is_null($data)) return response()->json(['msg' => 'no data in this range'],400);

        return response()->json($data,200);
        // return $data;

        // $ordered = Appointment::select('schedule_id')->selectRaw('count(schedule_id) as qty')->groupBy('schedule_id')->orderBy('qty', 'DESC')->get();

    }






}
