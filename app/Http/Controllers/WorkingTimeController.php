<?php

namespace App\Http\Controllers;

use App\WorkingTime;
use Illuminate\Http\Request;

class WorkingTimeController extends Controller
{
    public function add_time()
    {


        $page_option = ['main' => 'room', 'sub' => 'system_time'];
        $page_name = "Work Place Time";
        $breadcrums = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Work Place Time', 'url' => '#'],
        ];

        return view('page.workplace_time', compact('page_name', 'breadcrums', 'page_option'));
    }

}
