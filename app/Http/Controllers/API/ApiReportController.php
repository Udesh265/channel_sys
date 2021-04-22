<?php

namespace App\Http\Controllers\API;

use App\AddSpeciality;
use App\Appointment;
use App\Employee;
use App\Http\Controllers\Controller;
use App\JobType;
use App\Patient;
use App\Payment;
use App\Report_type;
use App\Schedule;
use App\Service;
use App\ServiceList;
use App\User;
use App\VisitingDoctorSalary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiReportController extends Controller
{

    public function get_active_emp_count()
    {

        $data = Employee::where('status', 1)->count();

        return response()->json($data, 200);
    }
    public function get_suspended_emp_count()
    {

        $data = Employee::where('status', 0)->count();

        return response()->json($data, 200);
    }
    public function get_active_user_count()
    {

        $data = Employee::whereIn('job_type_id', [1, 2,])->count();

        return response()->json($data, 200);
    }
    public function get_all_emp()
    {

        $data = Employee::get();

        foreach ($data as $d) {
            $d->job;
            // $d->user;
        }

        return response()->json($data, 200);
    }
    public function get_job_role()
    {

        $data = JobType::get();

        return response()->json($data, 200);
    }
    public function get_today_new_patients_count()
    {

        $data = Patient::whereDate('created_at', Carbon::today())->count();

        return response()->json($data, 200);
    }
    public function get_monthly_new_patients_count()
    {

        $data = Patient::whereMonth('created_at', Carbon::now()->month)->count();

        return response()->json($data, 200);
    }

    public function get_online_patients_count()
    {

        $data = Patient::where('p_type', 'online')->count();

        return response()->json($data, 200);
    }
    public function get_top_paid_patient_list(Request $request)
    {

        // return $request;

        $from = Carbon::parse($request->t_from);
        $to = Carbon::parse($request->t_to);
        $type = $request->type;
        $status = $request->status;
        $orderby = $request->orderBy;

        $data = Payment::with('patient')->whereBetween('created_at', [$from, $to])->where('type', $type)->where('payment_status', $status)->orderBy('amount', $orderby)->get();

        if (is_null($data)) return response()->json(['msg' => 'no data in this range'], 400);

        return response()->json($data, 200);
        // return $data;

        // $ordered = Appointment::select('schedule_id')->selectRaw('count(schedule_id) as qty')->groupBy('schedule_id')->orderBy('qty', 'DESC')->get();

    }

    public function top_appointments_list(Request $request)
    {

        $from = Carbon::parse($request->t_from);
        $to = Carbon::parse($request->t_to);

        $order = $request->orderBy;

        $list = AddSpeciality::with(['doctors' => function ($query) use ($from, $to, $order) {
            return $query->withCount(['appointments' => function ($query) use ($from, $to, $order) {
                return $query->whereBetween('created_at', [$from, $to])->orderBy('appointments_count', $order);
            }]);
        }])->get();

        $new_list = [];
        foreach ($list as $item) {

            $count = 0;

            foreach ($item->doctors as $doc) {
                $count += $doc->appointments_count;
            }

            $temp_object = (object) [
                'speciality_id' => $item->id,
                'speciality_name' => $item->name,
                'appointment_count' => $count,
                'doctors' => $item->doctors
            ];

            array_push($new_list, $temp_object);
        }


        return response()->json($new_list, 200);
    }

    public function get_today_new_appointment_count()
    {

        // $now =  Carbon::now();

        // $today = Carbon::parse($now);

        $data =  Appointment::whereDate('created_at', Carbon::today())->count();

        return response()->json($data, 200);
    }
    public function total_online_appointment_count()
    {

        $data = Appointment::with('payment')->get();

        foreach ($data as $d) {

            $s_count = Payment::where('type', 'Online')->count();
        }

        return $s_count;
    }
    public function total_onvisit_appointment_count()
    {

        $data = Appointment::with('payment')->get();

        foreach ($data as $d) {

            $s_count = Payment::where('type', 'On-Visit')->count();
        }

        return $s_count;
    }

    public function get_doc_appointment_amount(Request $request)
    {

        // $data = Appointment::with(['payment' => function($query) {
        //     return $query->whereDate('created_at',Carbon::today())->whereNotNull('created_at');
        // }])->get();

        $from = Carbon::parse($request->t_from);
        $to = Carbon::parse($request->t_to);

        $data = Payment::whereBetween('created_at', [$from, $to])->whereIn('type', ['On-Visit', 'Online'])->where('payment_status', 'Confirm')->sum('amount');

        return response()->json($data, 200);
    }
    public function get_service_amount(Request $request)
    {

        $from = Carbon::parse($request->t_from);
        $to = Carbon::parse($request->t_to);

        $data = Payment::whereBetween('created_at', [$from, $to])->whereIn('type', ['Services', 'Cash'])->where('payment_status', 'Confirm')->sum('amount');

        return response()->json($data, 200);
    }
    public function get_doctors_salary_amount(Request $request)
    {

        $from = Carbon::parse($request->t_from);
        $to = Carbon::parse($request->t_to);

        $data = VisitingDoctorSalary::whereBetween('created_at', [$from, $to])->where('status', 'paid')->sum('amount');

        return response()->json($data, 200);
    }


    public function get_top_service_list()
    {

        $data = Service::withCount('serviceList')->orderBy('service_list_count', 'desc')->get();

        return response()->json($data, 200);
    }
    public function get_top_lab_report_list()
    {

        $data = Report_type::withCount('labAppointment')->orderBy('lab_appointment_count', 'desc')->get();

        return response()->json($data, 200);
    }
    public function get_service_list(Request $request)
    {

        $from = $request->t_from;
        $to = $request->t_to;
        $type = $request->type;

        // $data = ServiceList::whereBetween('created_at', [$from, $to])->where('service_name',$type)->get();
        $data = Service::with(['serviceList' => function ($query) use ($from, $to) {
            return $query->whereBetween('created_at', [$from, $to]);
        }])->whereHas('serviceList')->find($type);


        return response()->json($data, 200);
    }
}
