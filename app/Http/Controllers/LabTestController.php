<?php

namespace App\Http\Controllers;

use App\LabTest;
use Illuminate\Http\Request;

class LabTestController extends Controller
{
    public function new_test_appointment()
    {
        $page_option = ['main' => 'lab_test', 'sub' => 'new_lab_test'];
        $page_name = "Lab Test Appointment";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'New Lab Appointment', 'url' => '#'],
        ];

        return view('page.lab.lab_test_appointment', compact('page_name', 'breadcrums', 'page_option'));
    }

    public function add_lab_report_type(){
        $page_option = ['main' => 'lab_test', 'sub' => 'report_type'];
        $page_name = "Add Test Report Type";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Report Types', 'url' => '#'],
        ];

        return view('page.lab.report_type', compact('page_name', 'breadcrums', 'page_option'));
    }


}
