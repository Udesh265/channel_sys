<?php

namespace App\Http\Controllers;

use App\JobType;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_option = ['main' => 'employee', 'sub' => 'employee_index'];
        $page_name = "Employee Index";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Employees', 'url' => '#'],
        ];

        return view('page.employee.index', compact('page_name', 'breadcrums', 'page_option'));
    }

    public function manage_emp(){

        $page_option = ['main' => 'employee', 'sub' => 'employee_manage'];
        $page_name = "Manage Employee";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Employees', 'url' => '#'],
        ];

        return view('page.employee.manage_emp', compact('page_name', 'breadcrums', 'page_option'));

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_option = ['main' => 'employee', 'sub' => 'employee_create'];
        $page_name = "Create New Employee";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Create', 'url' => '#'],
        ];

        return view('page.employee.create', compact('page_name', 'breadcrums', 'page_option'));
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
