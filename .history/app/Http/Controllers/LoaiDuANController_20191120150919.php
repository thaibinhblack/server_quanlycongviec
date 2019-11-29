<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoaiDuANController extends Controller
{
   
    public function CallFunction()
    {
        $sql = "DECLARE
            P_ID_LOAI_DU_AN NUMBER(10);
            P_TEN_LOAI_DU_AN VARCHAR2(50);
            P_MO_TA_LOAI_DU_AN VARCHAR2(255);
            P_GHI_CHU_LOAI_DU_AN VARCHAR2(255);
            P_TRANG_THAI_LOAI_DU_AN NUMBER(1);
            P_ACTION NUMBER(1);
        BEGIN
            :n := THEM_TK_TB_ND(:p_username,:p_password, :p_id_nhom, :p_sdt, :p_email,:p_gt, :p_ngaysinh, :p_action);
        END;";  
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':p_username',$username);
        $stmt->bindParam(':p_password',$password);
        $stmt->bindParam(':p_id_nhom',$p_id_nhom);
        $stmt->bindParam(':p_sdt',$p_sdt);
        $stmt->bindParam(':p_email',$p_email);
        $stmt->bindParam(':p_gt',$p_gt);
        $stmt->bindParam(':p_ngaysinh',$p_ngaysinh);
        $stmt->bindParam(':p_action',$p_action);
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
