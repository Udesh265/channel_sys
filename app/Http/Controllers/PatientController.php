<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_patient()
    {
        $page_option = ['main' => 'patient', 'sub' => 'add_patient'];
        $page_name = "Create New Patient";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Add Patient', 'url' => '#'],
        ];

        return view('page.patient.add_patient', compact('page_name', 'breadcrums', 'page_option'));
    }

    public function manage_patient(){
        $page_option = ['main' => 'patient', 'sub' => 'manage_patient'];
        $page_name = "Manage Patient";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Manage', 'url' => '#'],
        ];

        return view('page.patient.manage_patient', compact('page_name', 'breadcrums', 'page_option'));
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
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
