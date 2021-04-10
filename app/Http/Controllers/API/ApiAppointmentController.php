<?php

namespace App\Http\Controllers\API;

use App\Appointment;
use App\Http\Controllers\Controller;
use App\Lab_test_appointment;
use App\Patient;
use App\Payment;
use App\Schedule;
use App\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class ApiAppointmentController extends Controller
{

    public function get_schedule_appointment($employee_id)
    {

        $employee_schedules = Schedule::whereEmployeeId($employee_id)->get();

        return response()->json($employee_schedules, 200);
    }
    public function get_patient_by_user($patient_id)
    {
        $p_data = Patient::where('id', $patient_id)->first();

        return response()->json($p_data, 200);
    }
    public function get_patient_by_userID($user_id)
    {
        $p_data = Patient::where('user_id', $user_id)->first();

        return response()->json($p_data, 200);
    }

    public function submit_appointment(Request $request)
    {

        $validate_data = $request->validate(
            [
                'payment_method' => ['required'],
            ]
        );
        $data = Payment::create([

            'amount' => $request->charge_pp,
            'type' => $validate_data['payment_method'],
            'payment_status' => 'Pending',
            'patient_id' => $request->p_id,

        ]);
        if (is_null($data)) return response()->json(['msg' => 'Failed to create payment, rolling back'], 400);
        $data->id;



        $appointment_data = Appointment::create([
            'schedule_id' => $request->schedule_id,
            'user_id' => $request->user_id,
            'status' => 'active',
            'payment_id' =>    $data->id,
            'patient_id' => $request->p_id,
        ]);


        // Creating the token
        $current_token_length = Token::where('schedule_id', '=', $request->schedule_id)->count();
        $next_token = $current_token_length + 1;

        $token = Token::create([
            'appointment_id' => $appointment_data->id,
            'schedule_id' => $request->schedule_id,
            'status' => 'confirm',
            'token' => $next_token,
        ]);

        if (is_null($appointment_data)) {

            return response()->json(['msg' => 'Failed to create appoitnment, rolling back'], 400);
        }

        return response()->json(['msg' => 'Successfully create appoitnment', 'data' => ['payment' => $appointment_data]], 200);
    }

    public function get_appoitment_by_userID($user_id)
    {

        $data = Appointment::where('user_id', $user_id)->where('status', 'active')->count('id');


        return response()->json($data, 200);
    }
    public function get_app_total_amount($p_id)
    {
        $data = Payment::where('patient_id', $p_id)->where('payment_status', 'Confirm')->sum('amount');

        if (is_null($data)) return response()->json(['msg' => 'Failed to get total amount, rolling back'], 400);

        return response()->json($data, 200);
    }

    public function get_pending_payment($p_id)
    {
        $data = Payment::where('patient_id', $p_id)->where('payment_status', 'pending')->sum('amount');

        if (is_null($data)) return response()->json(['msg' => 'Failed to get total amount, rolling back'], 400);

        return response()->json($data, 200);
    }
    public function get_appointment_list($p_id)
    {
        $data = Appointment::where('patient_id', $p_id)->where('status', 'active')->get();
        if (is_null($data)) return response()->json(['msg' => 'Failed to get list rolling back'], 400);

        foreach ($data as $app) {

            $app->payment;
            $app->token;
            $app->schedule->room;
            $app->schedule->employee->doctor->speciality;
        }
        return response()->json($data, 200);
    }
    public function delete_appointment($id)
    {
        $data = Appointment::find($id);
        $data->update([
            'status' => 'Deleted'
        ]);
        if (is_null($data)) return response()->json(['msg' => 'Failed to delete Appoitnment, rolling back'], 400);

        return response()->json(['msg' => 'Successfully deleted'], 200);
    }
    public function delete_lab_appointment($id)
    {
        $data = Lab_test_appointment::find($id);
        $data->update([
            'status' => 'Cancel'
        ]);
        if (is_null($data)) return response()->json(['msg' => 'Failed to delete Appoitnment, rolling back'], 400);

        return response()->json(['msg' => 'Successfully deleted'], 200);
    }
}
