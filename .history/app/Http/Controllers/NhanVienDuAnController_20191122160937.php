<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class NhanVienDuAnController extends Controller
{
    
    public function CallFunction($P_ID_DU_AN, $P_ID_ND, $P_ACTION)
    {
        $sql = "DECLARE
            P_ID_DU_AN NUMBER(10);
            P_ID_ND NUMBER(10);
            P_ACTION NUMBER(1);
        BEGIN
            :n := THEM_CAPNHAT_NV_DA(:P_ID_DU_AN,:P_ID_ND, :P_ACTION);
        END;";  
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':P_ID_DU_AN',$P_ID_DU_AN);
        $stmt->bindParam(':P_ID_ND',$P_ID_ND);
        $stmt->bindParam(':P_ACTION',$P_ACTION);
        $stmt->bindParam(':n',$result);
        $stmt->execute();
        return $result;
    }


    public function index()
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
        if($request->has('api_token'))
        {
            $validate = $this->validate($request, [
                'P_ID_DU_AN' => 'required',
                'P_ID_ND' => 'required|max:1',
            ]);
            if($validate)
            {
                $P_ID_DU_AN = $request->get('P_ID_DU_AN');
                $P_ID_ND = $request->get('P_ID_ND');
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
