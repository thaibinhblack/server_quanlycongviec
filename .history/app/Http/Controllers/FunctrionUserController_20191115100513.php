<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class FunctrionUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('ID_ND')){
            $id = $request->get('ID_ND');
            $functions = DB::select("SELECT * FROM TB_CN_ND where ID_ND = $id");
            return response()->json($functions, 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate  = $this->validate($request,[
            'ID_ND' => 'required',
            'ID_CN' => 'required',
            'FUNCTIONS' => 'required'
        ]);
        if($validate)
        {
            $p_id_user = $request->get("ID_ND");
            $id_function = $request->get("ID_CN");
            $FUNCTIONS = $request->get("FUNCTIONS");
            $view = $create = $edit = $delete = $export = $id_function.'0';
            $array = explode(',', $FUNCTIONS);
            foreach ($array as $value) {
                if($value == $id_function.'.'.'1')
                {
                    $view = $value;
                }
                else if($value == $id_function.'.'.'2')
                {
                    $create = $value;
                }
                else if($value == $id_function.'.'.'3')
                {
                    $edit = $value;
                }
                else if($value == $id_function.'.'.'4')
                {
                    $delete = $value;
                }
            }
        }
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
