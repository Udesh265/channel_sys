<?php

namespace App\Http\Controllers\API;

use App\AddSpeciality;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class AddSpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */

    public function add_speciality(Request $request)
    {

        $addspec = AddSpeciality::create($request->all());

        if (is_null($addspec)) {
            return response()->json(['msg' => 'Not enter'], 400);
        }
            return response()->json(['msg' => 'success'], 200);
    }
    public function get_spec(){
        $addspec = AddSpeciality::select('id','name')->orderByDesc('id')->get();

        if(is_null($addspec)){
            return response()->json(['msg' => 'error'],400);
        }
            return response()->json($addspec,200);
    }

    public function del_spec($id){

        $del_spec = AddSpeciality::find($id);

        return $del_spec->delete();

           if(is_null($del_spec)){
                return response()->json(['msg'=>'error'],400);
           }
                return response()->json(['msg'=>'sucessfully deleted']);
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

    }
}
