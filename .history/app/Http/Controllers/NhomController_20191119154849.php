<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class NhomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = DB::select("SELECT NHOM.*,TT.TEN_TT, TT.ID_TT FROM TB_NHOM NHOM, TB_TRUNG_TAM TT where NHOM.ID_TT = TT.ID_TT");
        return response()->json($groups, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'ID_TT' => 'required',
            'TEN_NHOM' => 'required|max:50',
            'TRANG_THAI_NHOM' => 'required'
        ]);
        if($validate)
        {
            $sql = "DECLARE
                p_ten_nhom varchar(50);
                p_ghi_chu_nhom varchar(255);
                p_trang_thai_nhom number(1);
                p_mo_ta_nhom varchar(200);
            BEGIN
                :result := THEM_PHONG_BAN(:p_id_tt, :p_ten_nhom,:p_ghi_chu_nhom,:p_trang_thai_nhom,:p_mo_ta_nhom:,:p_kiem_tra_action,:p_id_nhom);
            END;";
            $p_id_tt =  $request->get("ID_TT");
            $p_ten_nhom = $request->get("TEN_NHOM");
            $p_trang_thai_nhom = $request->get("TRANG_THAI_NHOM");
            $p_ghi_chu_nhom = $request->get("GHI_CHU_NHOM") != 'undefined' ? $request->get("GHI_CHU_NHOM") : '';
            $p_mo_ta_nhom = $request->get("MO_TA_NHOM") != 'undefined' ? $request->get("MO_TA_NHOM") : '';
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':p_id_tt',$p_id_tt);
            $stmt->bindParam(':p_ten_nhom',$p_ten_nhom);
            $stmt->bindParam(':p_trang_thai_nhom',$p_trang_thai_nhom);
            $stmt->bindParam(':p_ghi_chu_nhom',$p_ghi_chu_nhom);
            $stmt->bindParam(':p_mo_ta_nhom',$p_mo_ta_nhom);
            $stmt->bindParam(':p_kiem_tra_action',1);
            $stmt->bindParam(':p_id_nhom',0);
            $stmt->bindParam(':result',$result);
            $stmt->execute();
            return response()->json($result, 200);
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
        $validate = $this->validate($request, [
            'ID_TT' => 'required',
            'TEN_NHOM' => 'required|max:50',
            'TRANG_THAI_NHOM' => 'required'
        ]);
        if($validate)
        {
            $sql = "DECLARE
                p_id_nhom number(10);
                p_ten_nhom varchar(50);
                p_ghi_chu_nhom varchar(255);
                p_trang_thai_nhom number(1);
                p_mo_ta_nhom varchar(200);
            BEGIN
                :result := CAP_NHAT_NHOM(:p_id_nhom,:p_id_tt, :p_ten_nhom,:p_ghi_chu_nhom,:p_trang_thai_nhom,:p_mo_ta_nhom);
            END;";
            $p_id_tt =  $request->get("ID_TT");
            $p_ten_nhom = $request->get("TEN_NHOM");
            $p_trang_thai_nhom = $request->get("TRANG_THAI_NHOM");
            $p_ghi_chu_nhom = $request->get("GHI_CHU_NHOM") != 'undefined' ? $request->get("GHI_CHU_NHOM") : '';
            $p_mo_ta_nhom = $request->get("MO_TA_NHOM") != 'undefined' ? $request->get("MO_TA_NHOM") : '';
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':p_id_tt',$p_id_tt);
            $stmt->bindParam(':p_ten_nhom',$p_ten_nhom);
            $stmt->bindParam(':p_trang_thai_nhom',$p_trang_thai_nhom);
            $stmt->bindParam(':p_ghi_chu_nhom',$p_ghi_chu_nhom);
            $stmt->bindParam(':p_mo_ta_nhom',$p_mo_ta_nhom);
            $stmt->bindParam(':result',$result);
            $stmt->execute();
            return response()->json($result, 200);
        }
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
