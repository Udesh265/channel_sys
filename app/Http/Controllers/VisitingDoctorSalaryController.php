<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitingDoctorSalaryController extends Controller
{

    public function visiting_doc_sal(){

        $page_option = ['main' => 'visiting', 'sub' => 'visiting_doc_sal'];
        $page_name = "Pay Visiting Doctors Salary (Day End Payments Only)";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Visiting Doctor Salary', 'url' => '#'],
        ];

        return view('page.report.pay_visiting_doctor_salary', compact('page_name', 'breadcrums', 'page_option'));

    }
}
