<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DuAnController extends Controller
{

    public function CallFunction($P_ID_DU_AN, $P_ID_LOAI_DU_AN, $P_TEN_DU_AN, $P_MO_TA_DU_AN, $P_GHI_CHU_DU_AN, $P_TRANG_THAI_DU_AN, $P_ID_KHACH_HANG, $P_ACTION)
    {
        $sql = "DECLARE
            P_ID_DU_AN NUMBER(10);
            P_ID_LOAI_DU_AN NUMBER(10);
            P_TEN_DU_AN VARCHAR2(50);
            P_MO_TA_DU_AN VARCHAR2(255);
            P_GHI_CHU_DU_AN VARCHAR2(255);
            P_TRANG_THAI_DU_AN NUMBER(1);
            P_ID_KHACH_HANG NUMBER(10);
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

    public function index(Request $request)
    {
        if($request->has('api_token'))
        {
            //CHECK TOKEN
            $du_an = DB::SELECT("SELECT DA.*, LOAI_DA.TEN_LOAI_DU_AN FROM TB_DU_AN DA, TB_LOAI_DA LOAI_DA WHERE DA.ID_LOAI_DU_AN = LOAI_DA.ID_LOAI_DU_AN");
            return response()->json($du_an, 200);
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
            'P_TEN_DU_AN' => 'required|max:50',
            'P_ID_LOAI_DU_AN' => 'required|max:1',
            'P_TRANG_THAI_DU_AN' => 'required|max:1'
        ]);
        if($validate)
        {
            if($request->has('api_token'))
            {
                //CHECK TOKEN
                $P_ID_DU_AN = 0; 
                $P_ID_LOAI_DU_AN = $request->get('P_ID_LOAI_DU_AN') ;
                $P_TEN_DU_AN = $request->get('P_TEN_DU_AN') ;
                $P_MO_TA_DU_AN = $request->get('P_MO_TA_DU_AN') != 'undefined' ? $request->get('P_MO_TA_DU_AN') : 'NULL' ;
                $P_GHI_CHU_DU_AN =  $request->get('P_GHI_CHU_DU_AN') != 'undefined'  ? $request->get('P_GHI_CHU_DU_AN') : 'NULL' ;
                $P_ID_KHACH_HANG =  $request->get('P_ID_KHACH_HANG') != 'undefined'  ? $request->get('P_ID_KHACH_HANG') : NULL ;
                $P_TRANG_THAI_DU_AN = $request->get('P_TRANG_THAI_DU_AN') ;
                $P_ACTION = 1;
                $result = $this->CallFunction($P_ID_DU_AN, $P_ID_LOAI_DU_AN, $P_TEN_DU_AN, $P_MO_TA_DU_AN, $P_GHI_CHU_DU_AN, $P_TRANG_THAI_DU_AN, $P_ID_KHACH_HANG, $P_ACTION);
                return response()->json([
                    'success' => true,
                    'message' => 'Thêm dự án',
                    'result' => $result,
                    'status' => 200
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
                $P_TEN_DU_AN = $request->get('P_TEN_DU_AN') ;
                $P_MO_TA_DU_AN = $request->get('P_MO_TA_DU_AN') != 'undefined' ? $request->get('P_MO_TA_DU_AN') : 'NULL' ;
                $P_GHI_CHU_DU_AN =  $request->get('P_GHI_CHU_DU_AN') != 'undefined'  ? $request->get('P_GHI_CHU_DU_AN') : 'NULL' ;
                $P_ID_KHACH_HANG =  $request->get('P_ID_KHACH_HANG') != 'undefined'  ? $request->get('P_ID_KHACH_HANG') : NULL ;
                $P_TRANG_THAI_DU_AN = $request->get('P_TRANG_THAI_DU_AN') ;
                $P_ACTION = 2;
                $result = $this->CallFunction($P_ID_DU_AN, $P_ID_LOAI_DU_AN, $P_TEN_DU_AN, $P_MO_TA_DU_AN, $P_GHI_CHU_DU_AN, $P_TRANG_THAI_DU_AN, $P_ID_KHACH_HANG, $P_ACTION);
                return response()->json([
                    'success' => true,
                    'message' => 'Thêm dự án',
                    'result' => $result,
                    'status' => 200
                ], 200);
            }
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
