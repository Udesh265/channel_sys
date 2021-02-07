<?php

namespace App\Http\Controllers;

use App\AddSpeciality;
use Illuminate\Http\Request;

class AddSpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_speciality(){

        $page_option = ['main' => 'doctor', 'sub' => 'add_speciality'];
        $page_name = "Add Speciality";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Doctor', 'url' => '#'],
        ];

        return view('page.doctor.add_speciality', compact('page_name', 'breadcrums', 'page_option'));

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
     * @param  \App\AddSpeciality  $addSpeciality
     * @return \Illuminate\Http\Response
     */
    public function show(AddSpeciality $addSpeciality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AddSpeciality  $addSpeciality
     * @return \Illuminate\Http\Response
     */
    public function edit(AddSpeciality $addSpeciality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AddSpeciality  $addSpeciality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AddSpeciality $addSpeciality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AddSpeciality  $addSpeciality
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddSpeciality $addSpeciality)
    {
        //
    }
}
