<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoaiDuANController extends Controller
{
   
    public function CallFunction($P_ID_LOAI_DU_AN, $P_TEN_LOAI_DU_AN, $P_MO_TA_LOAI_DU_AN, $P_GHI_CHU_LOAI_DU_AN, $P_TRANG_THAI_LOAI_DU_AN, $P_ACTION)
    {
        $sql = "DECLARE
            P_ID_LOAI_DU_AN NUMBER(10);
            P_TEN_LOAI_DU_AN VARCHAR2(50);
            P_MO_TA_LOAI_DU_AN VARCHAR2(255);
            P_GHI_CHU_LOAI_DU_AN VARCHAR2(255);
            P_TRANG_THAI_LOAI_DU_AN NUMBER(1);
            P_ACTION NUMBER(1);
        BEGIN
            :n := THEM_CAPNHAT_LOAI_DU_AN(:P_ID_LOAI_DU_AN,:P_TEN_LOAI_DU_AN, :P_MO_TA_LOAI_DU_AN, :P_GHI_CHU_LOAI_DU_AN, :P_TRANG_THAI_LOAI_DU_AN,:P_ACTION);
        END;";  
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':P_ID_LOAI_DU_AN',$P_ID_LOAI_DU_AN);
        $stmt->bindParam(':P_TEN_LOAI_DU_AN',$P_TEN_LOAI_DU_AN);
        $stmt->bindParam(':P_MO_TA_LOAI_DU_AN',$P_MO_TA_LOAI_DU_AN);
        $stmt->bindParam(':P_GHI_CHU_LOAI_DU_AN',$P_GHI_CHU_LOAI_DU_AN);
        $stmt->bindParam(':P_TRANG_THAI_LOAI_DU_AN',$P_TRANG_THAI_LOAI_DU_AN);
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
        $validate  = $this->validate($request,[
            'P_TEN_LOAI_DU_AN' => 'required|max:50',
            'P_TRANG_THAI_LOAI_DU_AN' => 'required|max:1'
        ]);
        if($validate)
        {
            if($request->has('api_token'))
            {
                //CHECK TOKEN
                $P_ID_LOAI_DU_AN = 0;
                $P_TEN_LOAI_DU_AN = $request->get('P_TEN_LOAI_DU_AN') ;
                $P_MO_TA_LOAI_DU_AN = $request->has('P_MO_TA_LOAI_DU_AN') == true ? $request->get('P_MO_TA_LOAI_DU_AN') : 'NULL' ;
                $P_GHI_CHU_LOAI_DU_AN =  $request->has('P_GHI_CHU_LOAI_DU_AN') == true ? $request->get('P_GHI_CHU_LOAI_DU_AN') : 'NULL' ;
                $P_TRANG_THAI_LOAI_DU_AN = $request->get('P_TRANG_THAI_LOAI_DU_AN') ;
                $P_ACTION = 1;


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
