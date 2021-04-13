<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function new_appointment(){

        $page_option = ['main' => 'appointment', 'sub' => 'new_appointment'];
        $page_name = "New Appointment";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Appointment', 'url' => '#'],
        ];

        return view('page.appointment.new_appointment', compact('page_name', 'breadcrums', 'page_option'));

    }
    public function view_appointment(){

        $page_option = ['main' => 'appointment', 'sub' => 'view_appointment'];
        $page_name = "View Appointment";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Appointment', 'url' => '#'],
        ];

        return view('page.appointment.view_appointment', compact('page_name', 'breadcrums', 'page_option'));

    }

    public function pay_online($payment_id){

        $payment_id = $payment_id;
        $page_option = ['main' => 'online_pay', 'sub' => 'pay_online'];
        $page_name = "Online Payment";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Online Payment', 'url' => '#'],
        ];

        return view('page.appointment.online_payment', compact('page_name', 'breadcrums', 'page_option', 'payment_id'));
    }

    public function waiting_online_payment(){


        $page_option = ['main' => 'appointment', 'sub' => 'waiting_online_payment'];
        $page_name = "Waiting Online Payment Confirmation";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'waiting_payment', 'url' => '#'],
        ];

        return view('page.appointment.waiting_online_payment', compact('page_name', 'breadcrums', 'page_option'));

    }
    public function check_doctors_avalable(){


        $page_option = ['main' => 'appointment', 'sub' => 'check_doc'];
        $page_name = "Check Doctors Availbility";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'check_doctors', 'url' => '#'],
        ];

        return view('page.appointment.check_doctors', compact('page_name', 'breadcrums', 'page_option'));

    }

    public function rep_doc_appointment(){

        $page_option = ['main' => 'cashier', 'sub' => 'doctor_appointment'];
        $page_name = "Doctors Appointments";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'doctors appointment', 'url' => '#'],
        ];

        return view('page.appointment.cashier.doctor_appointment', compact('page_name', 'breadcrums', 'page_option'));

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
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
