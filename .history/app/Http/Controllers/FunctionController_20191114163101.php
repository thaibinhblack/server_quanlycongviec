<?php

namespace App\Http\Controllers;

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
        $validate = $this->validate($request,[
            'MA_CN' => 'require',
            'TEN_CN' => 'require|max:50',
            'MO_TA_CN' => 'max:255',
            'GHI_CHU_CN' => 'max:100',
            'TRANG_THAI_CN' => 'require|max:1'
        ]);
        if($validate)
        {
            $sql = "DECLARE
            BEGIN
                :result := THEM_CHUC_NANG(:p_ma_cn,:p_ten_cn,:p_mo_ta_cn,:p_ghi_chu_cn,:p_tt_cn);
            END;";
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':p_ma_cn',$request->get('MA_CN'));
            $stmt->bindParam(':p_ten_cn',$request->get('TEN_CN'));
            $stmt->bindParam(':p_mo_ta_cn',$request->get('MO_TA_CN'));
            $stmt->bindParam(':p_ghi_chu_cn',$request->get('GHI_CHU_CN'));
            $stmt->bindParam(':p_tt_cn',$request->get('TRANG_THAI_CN'));
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
