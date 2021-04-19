<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function add_service(){
        $page_option = ['main' => 'cashier', 'sub' => 'services'];
        $page_name = "Services Manage";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Manage Services', 'url' => '#'],
        ];

        return view('page.services', compact('page_name', 'breadcrums', 'page_option'));
    }

    public function service_appointment(){

        $page_option = ['main' => 'cashier', 'sub' => 'add_service'];
        $page_name = "Services Appointments";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Services Appointments', 'url' => '#'],
        ];

        return view('page.appointment.cashier.new_service', compact('page_name', 'breadcrums', 'page_option'));

    }

}
