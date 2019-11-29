<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DB;
use Carbon\Carbon;

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
                $P_DO_UU_TIEN,
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
                $P_TRANG_THAI,
                $P_ACTION
    )
    {
        $sql = "DECLARE
        P_ID_CV_DA NUMBER(10);
        P_ID_DU_AN NUMBER(10);
        P_TEN_CV VARCHAR2(255);
        P_NOI_DUNG_CV VARCHAR2(255);
        P_NGAY_TIEP_NHAN DATE;
        P_NGAY_HOAN_THANH DATE;
        P_NGAY_CAM_KET DATE;
        P_GIO_THUC_HIEN DATE;
        P_DO_UU_TIEN NUMBER(1);
        P_MA_JIRA VARCHAR2(255);
        P_NGUOI_GIAO_VIEC VARCHAR2(255);
        P_NGUOI_NHAN_VIEC VARCHAR2(255);
        P_TIEN_DO NUMBER(1);
        P_GHI_CHU VARCHAR2(255);
        P_LY_DO VARCHAR2(255);
        P_THAM_DINH_TGIAN DATE;
        P_THAM_DINH_KHOI_LUONG NUMBER(1);
        P_THAM_DINH_CHAT_LUONG NUMBER(1);
        P_TRANG_THAI_LTRINH NUMBER(1);
        P_TRANG_THAI NUMBER(1);
        P_ACTION NUMBER(1);
    BEGIN
        :n := THEM_CAPNHAT_CONGVIEC(:P_ID_CV_DA,:P_ID_DU_AN, :P_TEN_CV, :P_NOI_DUNG_CV, :P_NGAY_TIEP_NHAN,:P_NGAY_HOAN_THANH, :P_NGAY_CAM_KET, :P_GIO_THUC_HIEN, :P_DO_UU_TIEN, 
    :P_MA_JIRA, :P_NGUOI_GIAO_VIEC, :P_NGUOI_NHAN_VIEC, :P_TIEN_DO, :P_GHI_CHU, :P_LY_DO, :P_THAM_DINH_TGIAN, :P_THAM_DINH_KHOI_LUONG, :P_THAM_DINH_CHAT_LUONG, :P_TRANG_THAI_LTRINH, 
    :P_TRANG_THAI, :P_ACTION);
    END;";  
    $pdo = DB::getPdo();
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':P_ID_CV_DA',$P_ID_CV_DA);
    $stmt->bindParam(':P_ID_DU_AN',$P_ID_DU_AN);
    $stmt->bindParam(':P_TEN_CV',$P_TEN_CV);
    $stmt->bindParam(':P_NOI_DUNG_CV',$P_NOI_DUNG_CV);
    $stmt->bindParam(':P_NGAY_TIEP_NHAN',$P_NGAY_TIEP_NHAN);
    $stmt->bindParam(':P_NGAY_HOAN_THANH',$P_NGAY_HOAN_THANH);
    $stmt->bindParam(':P_NGAY_CAM_KET',$P_NGAY_CAM_KET);
    $stmt->bindParam(':P_GIO_THUC_HIEN',$P_GIO_THUC_HIEN);
    $stmt->bindParam(':P_DO_UU_TIEN',$P_DO_UU_TIEN);
    $stmt->bindParam(':P_MA_JIRA',$P_MA_JIRA);
    $stmt->bindParam(':P_NGUOI_GIAO_VIEC',$P_NGUOI_GIAO_VIEC);
    $stmt->bindParam(':P_NGUOI_NHAN_VIEC',$P_NGUOI_NHAN_VIEC);
    $stmt->bindParam(':P_TIEN_DO',$P_TIEN_DO);
    $stmt->bindParam(':P_GHI_CHU',$P_GHI_CHU);
    $stmt->bindParam(':P_LY_DO',$P_LY_DO);
    $stmt->bindParam(':P_THAM_DINH_TGIAN',$P_THAM_DINH_TGIAN);
    $stmt->bindParam(':P_THAM_DINH_KHOI_LUONG',$P_THAM_DINH_KHOI_LUONG);
    $stmt->bindParam(':P_THAM_DINH_CHAT_LUONG',$P_THAM_DINH_CHAT_LUONG);
    $stmt->bindParam(':P_TRANG_THAI_LTRINH',$P_TRANG_THAI_LTRINH);
    $stmt->bindParam(':P_TRANG_THAI',$P_TRANG_THAI);
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
            'P_ID_DU_AN' => 'required',
            'P_TEN_CV' => 'required|max:50',
            'P_NGAY_TIEP_NHAN' => 'required',
            'P_NGAY_HOAN_THANH' => 'required',
            'P_NGUOI_GIAO_VIEC' => 'required',
            'P_TRANG_THAI' => 'required|max:1',
            'P_TRANG_THAI_LTRINH' => 'required|max:1',
            'P_DO_UU_TIEN' => 'required'
        ]);
        if($validate)
        {
            if($request->has('api_token'))
            {
                $P_ID_CV_DA = 0;
                $P_ID_DU_AN = $request->get('P_ID_DU_AN');
                $P_TEN_CV = $request->get('P_TEN_CV');
                $P_NGAY_TIEP_NHAN = $request->get('P_NGAY_TIEP_NHAN');
                $P_NGAY_HOAN_THANH = new Carbon($request->get('P_NGAY_HOAN_THANH'));
                $P_NGUOI_GIAO_VIEC = new Carbon($request->get('P_NGUOI_GIAO_VIEC'));
                return response()->json($$request->get('P_NGAY_HOAN_THANH'), 200);
                $P_TRANG_THAI = $request->get('P_TRANG_THAI');
                $P_DO_UU_TIEN = $request->get('P_DO_UU_TIEN');
                $P_NOI_DUNG_CV = $request->get('P_NOI_DUNG_CV') != 'undefined' ?  $request->get('P_NOI_DUNG_CV') : ''; 
                $P_NGAY_CAM_KET = $request->get('P_NGAY_CAM_KET') != 'undefined' ? new Carbon($request->get('P_NGAY_CAM_KET')) : NULL; 
                $P_GIO_THUC_HIEN =  $request->get('P_GIO_THUC_HIEN') != 'undefined' ?  $request->get('P_GIO_THUC_HIEN') : NULL; 
                $P_MA_JIRA = $request->get('P_MA_JIRA') != 'undefined' ?  $request->get('P_MA_JIRA') : NULL; 
                $P_NGUOI_NHAN_VIEC = $request->get('P_NGUOI_NHAN_VIEC') != 'undefined' ?  $request->get('P_NGUOI_NHAN_VIEC') : NULL; 
                $P_TIEN_DO = $request->get('P_TIEN_DO') != 'undefined' ?  $request->get('P_TIEN_DO') : NULL; 
                $P_GHI_CHU =  $request->get('P_GHI_CHU') != 'undefined' ?  $request->get('P_GHI_CHU') : NULL; 
                $P_LY_DO =  $request->get('P_LY_DO') != 'undefined' ?  $request->get('P_LY_DO') : NULL; 
                $P_THAM_DINH_TGIAN  =  $request->get('P_THAM_DINH_TGIAN') != 'undefined' ?  $request->get('P_THAM_DINH_TGIAN') : NULL; 
                $P_THAM_DINH_KHOI_LUONG =  $request->get('P_THAM_DINH_KHOI_LUONG') != 'undefined' ?  $request->get('P_THAM_DINH_KHOI_LUONG') : NULL; 
                $P_THAM_DINH_CHAT_LUONG =  $request->get('P_THAM_DINH_CHAT_LUONG') != 'undefined' ?  $request->get('P_THAM_DINH_CHAT_LUONG') : NULL; 
                $P_TRANG_THAI_LTRINH =  $request->get('P_TRANG_THAI_LTRINH') != 'undefined' ?  $request->get('P_TRANG_THAI_LTRINH') : NULL; 
                $P_ACTION = 1;
                $result = $this->CallFunction($P_ID_CV_DA,
                    $P_ID_DU_AN ,
                    $P_TEN_CV ,
                    $P_NOI_DUNG_CV ,
                    $P_NGAY_TIEP_NHAN ,
                    $P_NGAY_HOAN_THANH ,
                    $P_NGAY_CAM_KET,
                    $P_GIO_THUC_HIEN ,
                    $P_DO_UU_TIEN,
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
                    $P_TRANG_THAI,
                    $P_ACTION);
                return response()->json([
                    'success' => true,
                    'message' => 'Thêm công việc thành công',
                    'status' => 200
                ], 200);
            }
            else
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Không có quyền này',
                    'status' => 401
                ], 200);
            }
                
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        if($request->has('api_token'))
        {
            $cong_viec = DB::select("SELECT * FROM TB_CONG_VIEC_DA WHERE ID_DU_AN = $id");
            return response()->json($cong_viec, 200);
        }
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
        if($request->has('api_token'))
            {
                $P_ID_CV_DA = $id;
                $P_ID_DU_AN = NULL;
                $P_TEN_CV = NULL;
                $P_NGAY_TIEP_NHAN = NULL;
                $P_NGAY_HOAN_THANH = NULL;
                $P_NGUOI_GIAO_VIEC = NULL;
                $P_TRANG_THAI = $request->get('trang_thai');
                $P_DO_UU_TIEN = NULL;
                $P_NOI_DUNG_CV = NULL; 
                $P_NGAY_CAM_KET = NULL; 
                $P_GIO_THUC_HIEN =  NULL; 
                $P_MA_JIRA = NULL; 
                $P_NGUOI_NHAN_VIEC =NULL; 
                $P_TIEN_DO = NULL; 
                $P_GHI_CHU =  NULL; 
                $P_LY_DO = NULL; 
                $P_THAM_DINH_TGIAN  =  NULL; 
                $P_THAM_DINH_KHOI_LUONG = NULL; 
                $P_THAM_DINH_CHAT_LUONG =  NULL; 
                $P_TRANG_THAI_LTRINH =  NULL; 
                $P_ACTION = 3;
                $result = $this->CallFunction($P_ID_CV_DA,
                    $P_ID_DU_AN ,
                    $P_TEN_CV ,
                    $P_NOI_DUNG_CV ,
                    $P_NGAY_TIEP_NHAN ,
                    $P_NGAY_HOAN_THANH ,
                    $P_NGAY_CAM_KET,
                    $P_GIO_THUC_HIEN ,
                    $P_DO_UU_TIEN,
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
                    $P_TRANG_THAI,
                    $P_ACTION);
                return response()->json([
                    'success' => true,
                    'message' => 'Cập công việc thành công',
                    'status' => 200
                ], 200);
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
