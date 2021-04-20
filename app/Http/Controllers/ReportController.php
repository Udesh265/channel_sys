<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function emp_report_overview()
    {

        $page_option = ['main' => 'employee_report', 'sub' => 'report_overview'];
        $page_name = "Employee Management Report Overview";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'employee report', 'url' => '#'],
        ];

        return view('page.report.emp_report_management', compact('page_name', 'breadcrums', 'page_option'));
    }
    public function patient_report_overview()
    {

        $page_option = ['main' => 'patient', 'sub' => 'patient_overview'];
        $page_name = "Patient Management Report Overview";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'patient report', 'url' => '#'],
        ];

        return view('page.report.patient_mgt_report', compact('page_name', 'breadcrums', 'page_option'));
    }

    public function top_appointment_report()
    {

        $page_option = ['main' => 'appointment', 'sub' => 'top_appointment'];
        $page_name = "Top Appointments List Report ";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'patient report', 'url' => '#'],
        ];

        return view('page.report.appointment_mgt_report', compact('page_name', 'breadcrums', 'page_option'));
    }


}
