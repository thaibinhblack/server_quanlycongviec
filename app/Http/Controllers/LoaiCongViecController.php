<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LoaiCongViecController extends Controller
{
    public function CallFunction($ID_LOAI_CV, $TEN_LOAI_CV, $TRANG_THAI, $P_MO_TA, $P_ACTION)
    {
        $sql = "DECLARE
            P_ID_LOAI_CV NUMBER(10);
            P_TEN_LOAI_CV VARCHAR2(50);
            P_TRANG_THAI NUMBER(1);
            P_ACTION NUMBER(1);
        BEGIN
            :result := THEM_CAPNHAT_LOAI_CV(:P_ID_LOAI_CV,:P_TEN_LOAI_CV,:P_TRANG_THAI, :P_MO_TA, :P_ACTION);
        END;";
    
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':P_ID_LOAI_CV',$ID_LOAI_CV);
        $stmt->bindParam(':P_TEN_LOAI_CV',$TEN_LOAI_CV);
        $stmt->bindParam(':P_TRANG_THAI',$TRANG_THAI);
        $stmt->bindParam(':P_MO_TA',$P_MO_TA);
        $stmt->bindParam(':P_ACTION',$P_ACTION);
        $stmt->bindParam(':result',$result);
        // return response()->json($stmt, 200);
        $stmt->execute();
        return $result;
    }


    public function index(Request $request)
    {
        if($request->has('api_token'))
        {
            $loai_cv = DB::SELECT("SELECT * FROM TB_LOAI_CV");
            return response()->json($loai_cv, 200);
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
        if($request->has('api_token'))
        {
            $validate = $this->validate($request,[
                'P_TEN_LOAI_CV' => 'required|max:50',
                'P_TRANG_THAI' => 'required|max:1',
            ]);    
            if($validate)
            {
                $ID_LOAI_CV = 0;
                $TEN_LOAI_CV = $request->get('P_TEN_LOAI_CV');
                $TRANG_THAI = $request->get("P_TRANG_THAI");
                $P_MO_TA = $request->get("P_MO_TA") != 'undefined' ? $request->get('P_MO_TA') : NULL;
                $P_ACTION = 1;
                $reuslt = $this->CallFunction($ID_LOAI_CV, $TEN_LOAI_CV, $TRANG_THAI, $P_MO_TA, $P_ACTION);
                return response()->json([
                    'success' => true,
                    'message' => 'Thêm loại công việc mới thành công',
                    'result' => $reuslt,
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
        if($request->has("api_token"))
        {
            //CHECK TOKEN
            $ID_LOAI_CV = $id;
            $TEN_LOAI_CV = $request->get('P_TEN_LOAI_CV');
            $TRANG_THAI = $request->get("P_TRANG_THAI");
            $P_MO_TA = $request->get("P_MO_TA") != 'undefined' ? $request->get('P_MO_TA') : NULL;
            $P_ACTION = 2;
            $reuslt = $this->CallFunction($ID_LOAI_CV, $TEN_LOAI_CV, $TRANG_THAI, $P_MO_TA, $P_ACTION);
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật '.$TEN_LOAI_CV. ' thành công',
                'result' => $reuslt,
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
