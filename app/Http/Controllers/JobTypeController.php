<?php

namespace App\Http\Controllers;

use App\JobType;
use Illuminate\Http\Request;

class JobTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_option = ['main' => 'employee', 'sub' => 'jobtype_create'];
        $page_name = "Add New Job Type";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Create', 'url' => '#'],
        ];

        return view('page.employee.job_type', compact('page_name', 'breadcrums', 'page_option'));

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
     * @param  \App\JobType  $jobType
     * @return \Illuminate\Http\Response
     */
    public function show(JobType $jobType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobType  $jobType
     * @return \Illuminate\Http\Response
     */
    public function edit(JobType $jobType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobType  $jobType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobType $jobType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobType  $jobType
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobType $jobType)
    {
        //
    }
}
