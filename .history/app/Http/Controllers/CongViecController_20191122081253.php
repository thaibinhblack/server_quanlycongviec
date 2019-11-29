<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CongViecController extends Controller
{
    
    public function CallFunction($P_ID_CV_DA,
                $P_ID_DU_AN ,
                $P_TEN_CV ,
                $P_NOI_DUNG_CV ,
                $P_NGAY_TIEP_NHAN ,
                $P_NGAY_HOAN_THANH ,
                $P_NGAY_CAM_KET,
                $P_GIO_THUC_HIEN ,
                $P_MA_JIRA ,
                $P_NGUOI_GIAO_VIEC ,
                $P_NGUOI_NHAN_VIEC ,
                $P_TIEN_DO ,
                $P_GHI_CHU ,
                $P_LY_DO ,
                $P_THAM_DINH_TGIAN ,
                $P_THAM_DINH_KHOI_LUONG,
                $P_THAM_DINH_CHAT_LUONG,
                $P_TRANG_THAI_LTRINH,
                $P_TRANG_THAI
    )
    {
        $sql = "DECLARE
        P_ID_CV_DA NUMBER(10);
        P_ID_DU_AN NUMBER(10)
        P_TEN_CV VARCHAR2(255);
        P_NOI_DUNG_CV VARCHAR2(255);
        P_NGAY_TIEP_NHAN DATE;
        P_NGAY_HOAN_THANH DATE;
        P_NGAY_CAM_KET DATE;
        P_GIO_THUC_HIEN DATE;
        P_MA_JIRA VARCHAR2(255),
        P_NGUOI_GIAO_VIEC VARCHAR2(255),
        P_NGUOI_NHAN_VIEC VARCHAR2(255),
        P_TIEN_DO NUMBER(1),
        P_GHI_CHU VARCHAR2(255),
        P_LY_DO VARCHAR2(255);
        P_THAM_DINH_TGIAN DATE;
        P_THAM_DINH_KHOI_LUONG NUMBER(1);
        P_THAM_DINH_CHAT_LUONG NUMBER(1);
        P_TRANG_THAI_LTRINH NUMBER(1);
        P_TRANG_THAI NUMBER(1);
        P_ACTION NUMBER(1);
    BEGIN
        :n := THEM_UPDATE_DU_AN(:P_ID_DU_AN,:P_ID_LOAI_DU_AN, :P_TEN_DU_AN, :P_MO_TA_DU_AN, :P_GHI_CHU_DU_AN,:P_TRANG_THAI_DU_AN, :P_ID_KHACH_HANG, :P_ACTION);
    END;";  
    $pdo = DB::getPdo();
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':P_ID_DU_AN',$P_ID_DU_AN);
    $stmt->bindParam(':P_ID_LOAI_DU_AN',$P_ID_LOAI_DU_AN);
    $stmt->bindParam(':P_TEN_DU_AN',$P_TEN_DU_AN);
    $stmt->bindParam(':P_MO_TA_DU_AN',$P_MO_TA_DU_AN);
    $stmt->bindParam(':P_GHI_CHU_DU_AN',$P_GHI_CHU_DU_AN);
    $stmt->bindParam(':P_TRANG_THAI_DU_AN',$P_TRANG_THAI_DU_AN);
    $stmt->bindParam(':P_ID_KHACH_HANG',$P_ID_KHACH_HANG);
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
