<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\JobType;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class ApiJobTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $job_list = JobType::select('id','name')->orderByDesc('id')->get();

        if(is_null($job_list)){
            return response()->json(['msg' => 'faild'],400);
        }
            return response()->json($job_list,200);
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
       $job = JobType::create($request->all());

       if(is_null($job)){
         return  response()->json(['msg' => 'faild'],400);
       }
            return response()->json(['msg' => 'success'],200);
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
        $del_job = JobType::find($id);
        return $del_job->delete();

        if(is_null($del_job)){
            return response()->json(['msg' => 'faild'],400);
        }
            return response()->json(['msg' => 'Successfully Deleted'],200);
    }
}
