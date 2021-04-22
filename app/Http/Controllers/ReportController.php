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
    public function top_lab_appointment_report()
    {

        $page_option = ['main' => 'lab_appointment', 'sub' => 'top_lab_appointment'];
        $page_name = "Top Lab Appointments Types List Report ";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'lab app report', 'url' => '#'],
        ];

        return view('page.report.top_lab_appointment_report', compact('page_name', 'breadcrums', 'page_option'));
    }
    public function lab_appointment_list_report()
    {

        $page_option = ['main' => 'lab_appointment', 'sub' => 'lab_app_appointment_list'];
        $page_name = "Lab Appointments List Report ";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'lab app list', 'url' => '#'],
        ];

        return view('page.report.lab_appointment_list', compact('page_name', 'breadcrums', 'page_option'));
    }
    public function income_statement_report()
    {

        $page_option = ['main' => 'incomereport', 'sub' => 'income'];
        $page_name = "Income Statement Report ";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'income', 'url' => '#'],
        ];

        return view('page.report.income_statement_report', compact('page_name', 'breadcrums', 'page_option'));
    }
    public function service_top()
    {

        $page_option = ['main' => 'incomereport', 'sub' => 'top_service'];
        $page_name = "Top Services List ";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'top_service', 'url' => '#'],
        ];

        return view('page.report.top_service_list', compact('page_name', 'breadcrums', 'page_option'));
    }
    public function service_list()
    {

        $page_option = ['main' => 'incomereport', 'sub' => 'service_list'];
        $page_name = "Services List ";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'service_list', 'url' => '#'],
        ];

        return view('page.report.service_list', compact('page_name', 'breadcrums', 'page_option'));
    }






}
