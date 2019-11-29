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

    public function CallFunctionQuyen($P_ID_QUYEN_DA, $P_ID_ND, $P_ID_DU_AN, $P_Q_XEM, $P_Q_THEM, $P_Q_SUA, $P_Q_XOA, $P_Q_XUAT, $P_ACTION)
    {
        $sql = "DECLARE
            P_ID_QUYEN_DA NUMBER;
            P_ID_ND NUMBER;
            P_ID_DU_AN NUMBER;
            P_Q_XEM VARCHAR2(20);
            P_Q_THEM VARCHAR2(20);
            P_Q_SUA VARCHAR2(20);
            P_Q_XOA VARCHAR2(20);
            P_Q_XUAT VARCHAR2(20);
            P_ACTION NUMBER;
        BEGIN
            :n := THEM_CAPNHAT_QUYEN_DUAN(:P_ID_QUYEN_DA, :P_ID_ND, :P_ID_DU_AN, :P_Q_XEM, :P_Q_THEM,:P_Q_SUA, :P_Q_XOA, :P_Q_XUAT,:P_ACTION);
        END;";  
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':P_ID_QUYEN_DA',$P_ID_QUYEN_DA);
        $stmt->bindParam(':P_ID_ND',$P_ID_ND);
        $stmt->bindParam(':P_ID_DU_AN',$P_ID_DU_AN);
        $stmt->bindParam(':P_Q_XEM',$P_Q_XEM);
        $stmt->bindParam(':P_Q_THEM',$P_Q_THEM);
        $stmt->bindParam(':P_Q_SUA',$P_Q_SUA);
        $stmt->bindParam(':P_Q_XOA',$P_Q_XOA);
        $stmt->bindParam(':P_Q_XUAT',$P_Q_XUAT);
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
    
    public function nhanvien_duan(Request $request)
    {
        if($request->get('api_token'))
        {
            if($request->get('id_du_an_kh'))
            {
                $id_du_an_kh = $request->get('id_du_an_kh');
                $users = DB::SELECT("SELECT QUYEN.*, ND.username_nd, ND.id_nd FROM TB_QUYEN_DA QUYEN, TB_NGUOI_DUNG ND WHERE ID_DU_AN = $id_du_an_kh and QUYEN.ID_ND = ND.ID_ND");
                return response()->json($users, 200);
            }
        }
    }
    public function store(Request $request)
    {
        $validate  = $this->validate($request,[
            'P_TEN_DU_AN_KH' => 'required|max:50',
            'P_ID_DU_AN' => 'required|max:1',
            'P_TRANG_THAI_DU_AN' => 'required|max:1'
        ]);
        if($validate)
        {
            if($request->has('api_token'))
            {
                $TOKEN = $request->get('api_token');
                $user = DB::SELECT("SELECT id_nd from TB_NGUOI_DUNG WHERE TOKEN_ND = '$TOKEN'");

                $P_ID_DU_AN_KH = 0; 
                $P_ID_DU_AN = $request->get('P_ID_DU_AN') ;
                $P_TEN_DU_AN_KH = $request->get('P_TEN_DU_AN_KH') ;
                $P_MO_TA_DU_AN = $request->get('P_MO_TA_DU_AN') != 'undefined' ? $request->get('P_MO_TA_DU_AN') : 'NULL' ;
                $P_GHI_CHU_DU_AN =  $request->get('P_GHI_CHU_DU_AN') != 'undefined'  ? $request->get('P_GHI_CHU_DU_AN') : 'NULL' ;
                $P_ID_KHACH_HANG =  $request->get('P_ID_KHACH_HANG') != 'undefined'  ? $request->get('P_ID_KHACH_HANG') : NULL ;
                $P_TRANG_THAI_DU_AN = $request->get('P_TRANG_THAI_DU_AN') ;
                $P_ACTION = 1;
                // $result =1 ;
                $result = $this->CallFunction($P_ID_DU_AN_KH, $P_ID_DU_AN, $P_TEN_DU_AN_KH, $P_MO_TA_DU_AN, $P_GHI_CHU_DU_AN, $P_TRANG_THAI_DU_AN, $P_ID_KHACH_HANG, $P_ACTION);
                if($result)
                {
                    $ID_DU_AN_KH = DB::SELECT("SELECT  max(id_du_an_kh) AS ID_DU_AN_KH from tb_du_an_kh");
                    // return response()->json($ID_DU_AN_KH, 200);
                    $KQ = $this->CallFunctionQuyen(0,$user[0]->id_nd, $ID_DU_AN_KH[0]->id_du_an_kh, $ID_DU_AN_KH[0]->id_du_an_kh.'.1', $ID_DU_AN_KH[0]->id_du_an_kh.'.2', $ID_DU_AN_KH[0]->id_du_an_kh.'.3', $ID_DU_AN_KH[0]->id_du_an_kh.'.4', $ID_DU_AN_KH[0]->id_du_an_kh.'.5',1 );
                    return response()->json([
                        'success' => true,
                        'message' => 'Thêm dự án',
                        'result' => $KQ,
                        'status' => 200
                    ], 200);
                }
                return response()->json([
                    'success' =>  false,
                    'message' => 'Thêm dự án thất bại',
                    'result' => '',
                    'status' => 200
                ], 200);
                
            }
        }
    }

    public function themthanhvien(Request $request)
    {
        if($request->has('api_token'))
        {
            
            $array = explode(',', $request->get('array_nv'));
            $id_du_an_kh = $request->get('id_du_an_kh');
            foreach ($array as $value) {
                $check = DB::SELECT("SELECT COUNT(id_nd) as check_nv from TB_QUYEN_DA where ID_ND = $value and ID_DU_AN = $id_du_an_kh");
                if($check[0]->check_nv == 0)
                {
                    $result =$this->CallFunctionQuyen(0,$value, $id_du_an_kh, $id_du_an_kh.'.1', $id_du_an_kh.'.2', $id_du_an_kh.'.3', $id_du_an_kh.'.4', $id_du_an_kh.'.5',1 );
                    return response()->json($result, 200);
                }
                
            }
           
        }
    }

    public function update_quyen_thanhvien(Request $request)
    {
        $id_nd = $request->get('id_nd');
        $id_du_an_kh = $request->get('id_du_an_kh');
        $view = $create = $edit = $delete = $export = $id_du_an_kh.'.0';
        $array = explode(',', $request->get('array_nv'));
        foreach ($array as $value ) {
            if($value == $id_du_an_kh.'.1')
            {
                $view =  $id_du_an_kh.'.1';
            }
            if($value == $id_du_an_kh.'.2')
            {
                $create =  $id_du_an_kh.'.2';
            }
            if($value == $id_du_an_kh.'.3')
            {
                $edit =  $id_du_an_kh.'.3';
            }
            if($value == $id_du_an_kh.'.4')
            {
                $delete =  $id_du_an_kh.'.4';
            }
            if($value == $id_du_an_kh.'.5')
            {
                $export =  $id_du_an_kh.'.5';
            }
            // $result =$this->CallFunctionQuyen($,$value, $id_du_an_kh, $id_du_an_kh.'.1', $id_du_an_kh.'.2', $id_du_an_kh.'.3', $id_du_an_kh.'.4', $id_du_an_kh.'.5',1 );
        }

    }

    public function show_quyen_thanhvien(Request $request)
    {
        if($request->get('api_token'))
        {
            $validate  = $this->validate($request,[
                'id_nd' => 'required',
                'id_du_an_kh' => 'required',
            ]);
            if($validate)
            {
                $id_nd = $request->get('id_nd');
                $id_du_an_kh = $request->get('id_du_an_kh');
                $quyen = DB::SELECT("SELECT q_xem,q_them,q_sua,q_xoa,q_xuat FROM TB_QUYEN_DA WHERE id_nd = $id_nd and id_du_an = $id_du_an_kh");
                return response()->json($quyen, 200);
            }
           
        }
    }

    public function show(Request $request,$id){
        if($request->has('api_token'))
        {
            $du_an = DB::SELECT("SELECT * FROM TB_DU_AN_KH WHERE ID_DU_AN_KH = $id");
            return response()->json($du_an, 200);
        }
    }
    public function update(Request $request, $id)
    {
        $validate  = $this->validate($request,[
            'P_TEN_DU_AN_KH' => 'required|max:50',
            'P_ID_DU_AN' => 'required|max:1',
            'P_TRANG_THAI_DU_AN' => 'required|max:1'
        ]);
        if($validate)
        {
            if($request->has('api_token'))
            {
                //CHECK TOKEN
                $P_ID_DU_AN_KH = $id; 
                $P_ID_DU_AN = $request->get('P_ID_DU_AN') ;
                $P_TEN_DU_AN_KH = $request->get('P_TEN_DU_AN_KH') ;
                $P_MO_TA_DU_AN = $request->get('P_MO_TA_DU_AN') != 'undefined' ? $request->get('P_MO_TA_DU_AN') : 'NULL' ;
                $P_GHI_CHU_DU_AN =  $request->get('P_GHI_CHU_DU_AN') != 'undefined'  ? $request->get('P_GHI_CHU_DU_AN') : 'NULL' ;
                $P_ID_KHACH_HANG =  $request->get('P_ID_KHACH_HANG') != 'undefined'  ? $request->get('P_ID_KHACH_HANG') : NULL ;
                $P_TRANG_THAI_DU_AN = $request->get('P_TRANG_THAI_DU_AN') ;
                $P_ACTION = 2;
                $result = $this->CallFunction($P_ID_DU_AN_KH, $P_ID_DU_AN, $P_TEN_DU_AN_KH, $P_MO_TA_DU_AN, $P_GHI_CHU_DU_AN, $P_TRANG_THAI_DU_AN, $P_ID_KHACH_HANG, $P_ACTION);
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
