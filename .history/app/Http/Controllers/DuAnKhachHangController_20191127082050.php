<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DuAnKhachHangController extends Controller
{
    public function CallFunction($P_ID_DU_AN_KH, $P_ID_DU_AN, $P_TEN_DU_AN_KH, $P_MO_TA_DU_AN, $P_GHI_CHU_DU_AN, $P_TRANG_THAI_DU_AN, $P_ID_KHACH_HANG, $P_ACTION)
    {
        $sql = "DECLARE
            P_ID_DU_AN_KH NUMBER(10);
            P_ID_DU_AN NUMBER(10);
            P_TEN_DU_AN_KH VARCHAR2(50);
            P_MO_TA_DU_AN VARCHAR2(255);
            P_GHI_CHU_DU_AN VARCHAR2(255);
            P_TRANG_THAI_DU_AN NUMBER(1);
            P_ID_KHACH_HANG NUMBER(10);
            P_ACTION NUMBER(1);
        BEGIN
            :n := THEM_UPDATE_DU_AN_KH(:P_ID_DU_AN_KH, :P_ID_DU_AN, :P_TEN_DU_AN_KH, :P_MO_TA_DU_AN, :P_GHI_CHU_DU_AN,:P_TRANG_THAI_DU_AN, :P_ID_KHACH_HANG, :P_ACTION);
        END;";  
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':P_ID_DU_AN_KH',$P_ID_DU_AN_KH);
        $stmt->bindParam(':P_ID_DU_AN',$P_ID_DU_AN);
        $stmt->bindParam(':P_TEN_DU_AN_KH',$P_TEN_DU_AN_KH);
        $stmt->bindParam(':P_MO_TA_DU_AN',$P_MO_TA_DU_AN);
        $stmt->bindParam(':P_GHI_CHU_DU_AN',$P_GHI_CHU_DU_AN);
        $stmt->bindParam(':P_TRANG_THAI_DU_AN',$P_TRANG_THAI_DU_AN);
        $stmt->bindParam(':P_ID_KHACH_HANG',$P_ID_KHACH_HANG);
        $stmt->bindParam(':P_ACTION',$P_ACTION);
        $stmt->bindParam(':n',$result);
        $stmt->execute();
        return $result;
    }

    public function index(Request $request)
    {
        if($request->has('api_token'))
        {
            //CHECK TOKEN
            $du_an = DB::SELECT("SELECT DA_KH.*, DA.TEN_DU_AN, KH.TEN_KH, KH.ID_KHACH_HANG FROM TB_DU_AN_KH DA_KH, TB_DU_AN DA, TB_KH KH
            WHERE DA_KH.ID_DU_AN = DA.ID_DU_AN AND DA_KH.ID_KHACH_HANG = KH.ID_KHACH_HANG  ");
            return response()->json($du_an, 200);
        }
    }
    

    public function store(Request $request)
    {
        $validate  = $this->validate($request,[
            'P_TEN_DU_AN' => 'required|max:50',
            'P_ID_DU_AN' => 'required|max:1',
            'P_TRANG_THAI_DU_AN' => 'required|max:1'
        ]);
        if($validate)
        {
            if($request->has('api_token'))
            {
                //CHECK TOKEN
                $P_ID_DU_AN_KH = 0; 
                $P_ID_DU_AN = $request->get('P_ID_LOAI_DU_AN') ;
                $P_TEN_DU_AN = $request->get('P_TEN_DU_AN_KH') ;
                $P_MO_TA_DU_AN = $request->get('P_MO_TA_DU_AN') != 'undefined' ? $request->get('P_MO_TA_DU_AN') : 'NULL' ;
                $P_GHI_CHU_DU_AN =  $request->get('P_GHI_CHU_DU_AN') != 'undefined'  ? $request->get('P_GHI_CHU_DU_AN') : 'NULL' ;
                $P_ID_KHACH_HANG =  $request->get('P_ID_KHACH_HANG') != 'undefined'  ? $request->get('P_ID_KHACH_HANG') : NULL ;
                $P_TRANG_THAI_DU_AN = $request->get('P_TRANG_THAI_DU_AN') ;
                $P_ACTION = 1;
                $result = $this->CallFunction($P_ID_DU_AN_KH, $P_ID_DU_AN, $P_TEN_DU_AN, $P_MO_TA_DU_AN, $P_GHI_CHU_DU_AN, $P_TRANG_THAI_DU_AN, $P_ID_KHACH_HANG, $P_ACTION);
                return response()->json([
                    'success' => true,
                    'message' => 'Thêm dự án',
                    'result' => $result,
                    'status' => 200
                ], 200);
            }
        }
    }


    public function update(Request $request, $id)
    {
        $validate  = $this->validate($request,[
            'P_TEN_DU_AN' => 'required|max:50',
            'P_ID_LOAI_DU_AN' => 'required|max:1',
            'P_TRANG_THAI_DU_AN' => 'required|max:1'
        ]);
        if($validate)
        {
            if($request->has('api_token'))
            {
                //CHECK TOKEN
                $P_ID_DU_AN = $id; 
                $P_ID_LOAI_DU_AN = $request->get('P_ID_LOAI_DU_AN') ;
                $P_TEN_DU_AN = $request->get('P_TEN_DU_AN_KH') ;
                $P_MO_TA_DU_AN = $request->get('P_MO_TA_DU_AN') != 'undefined' ? $request->get('P_MO_TA_DU_AN') : 'NULL' ;
                $P_GHI_CHU_DU_AN =  $request->get('P_GHI_CHU_DU_AN') != 'undefined'  ? $request->get('P_GHI_CHU_DU_AN') : 'NULL' ;
                $P_ID_KHACH_HANG =  $request->get('P_ID_KHACH_HANG') != 'undefined'  ? $request->get('P_ID_KHACH_HANG') : NULL ;
                $P_TRANG_THAI_DU_AN = $request->get('P_TRANG_THAI_DU_AN') ;
                $P_ACTION = 2;
                $result = $this->CallFunction($P_ID_DU_AN, $P_ID_LOAI_DU_AN, $P_TEN_DU_AN, $P_MO_TA_DU_AN, $P_GHI_CHU_DU_AN, $P_TRANG_THAI_DU_AN, $P_ID_KHACH_HANG, $P_ACTION);
                return response()->json([
                    'success' => true,
                    'message' => 'Cập nhật dự án',
                    'result' => $result,
                    'status' => 200
                ], 200);
            }
        }
    }

}
