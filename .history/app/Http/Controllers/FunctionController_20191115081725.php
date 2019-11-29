<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class FunctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $sql = "exec DS_CHUC_NANG();";
        // $pdo = DB::getPdo();
        // $stmt = $pdo->prepare($sql);

        // $result = $stmt->execute();
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("exec DS_CHUC_NANG( :result)");
        $stmt->bindParam(':result',$result);
        // $sql = "CALL DS_CHUC_NANG(:result);";
        // $pdo = DB::getPdo();
        // $stmt = $pdo->prepare($sql);
        // $stmt->bindParam(':result',$result);
        return response()->json($result, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request->all(), 200);
        $validate = $this->validate($request,[
            'MA_CN' => 'required',
            'TEN_CN' => 'required|max:50',
            'TRANG_THAI_CN' => 'required|max:3'
        ]);
        
        if($validate)
        {
            $sql = "DECLARE
                p_ma_cn varchar(200);
                p_ten_cn varchar(200);
                p_mo_ta_cn varchar(200);
                p_ghi_chu_cn varchar(200);
                p_tt_cn number(1);
            BEGIN
                :result := THEM_CHUC_NANG(:p_ma_cn,:p_ten_cn,:p_mo_ta_cn,:p_ghi_chu_cn,:p_tt_cn);
            END;";
            $ma_cn = $request->get('MA_CN');
            $p_ten_cn = $request->get('TEN_CN');
            $p_mo_ta_cn = $request->get('MO_TA_CN');
            $p_ghi_chu_cn = $request->get('GHI_CHU_CN');
            $p_tt_cn = $request->get('TRANG_THAI_CN');
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':p_ma_cn',$ma_cn);
            $stmt->bindParam(':p_ten_cn',$p_ten_cn);
            $stmt->bindParam(':p_mo_ta_cn',$p_mo_ta_cn);
            $stmt->bindParam(':p_ghi_chu_cn',$p_ghi_chu_cn);
            $stmt->bindParam(':p_tt_cn',$p_tt_cn);
            $stmt->bindParam(':result',$result);
            // return response()->json($stmt, 200);
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
