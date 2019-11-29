<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LoaiCongViecController extends Controller
{
    public function CallFunction($ID_LOAI_CV, $TEN_LOAI_CV, $TRANG_THAI, $P_ACTION)
    {
        $sql = "DECLARE
            P_ID_LOAI_CV NUMBER(10);
            P_TEN_LOAI_CV VARCHAR2(50);
            P_TRANG_THAI NUMBER(1);
            P_ACTION NUMBER(1);
        BEGIN
            :result := THEM_CAPNHAT_LOAI_CV(:P_ID_LOAI_CV,:P_TEN_LOAI_CV,:P_TRANG_THAI, :P_ACTION);
        END;";
    
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':P_ID_LOAI_CV',$P_ID_LOAI_CV);
        $stmt->bindParam(':P_TEN_LOAI_CV',$P_TEN_LOAI_CV);
        $stmt->bindParam(':P_TRANG_THAI',$P_TRANG_THAI);
        $stmt->bindParam(':P_ACTION',$P_ACTION);
        $stmt->bindParam(':result',$result);
        // return response()->json($stmt, 200);
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
