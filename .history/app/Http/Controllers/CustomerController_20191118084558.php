<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = DB::select("SELECT * FROM TB_KH");
        return response()->json([
            'success' => true,
            'message' => 'Danh sách khách hàng',
            'results' => $customers
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('token'))
        {
            $validate = $this->validate($request,[
                'TEN_KH' => 'required|max:100',
                'DIA_CHI_KH' => 'required|max:255',
                'SDT_KH' => 'required|max:14',
                'NGUOI_DAI_DIEN_KH' => 'required|max:100',
                'TRANG_THAI_CN' => 'required|max:1'
            ]);    
            //CHECK TOKEN
            $sql = "DECLARE
                p_ten_kh varchar(200);
                p_dia_chi_kh varchar(200);
                p_sdt_kh varchar(200);
                p_nguoi_dai_dien varchar(200);
                p_trang_thai_kh number(1);
            BEGIN
                :result := THEM_KH(:p_ten_kh,:p_dia_chi_kh,:p_sdt_kh,:p_nguoi_dai_dien,:p_trang_thai_kh);
            END;";
            $p_ma_cn = $request->get('MA_CN');
            $p_ten_cn = $request->get('TEN_CN');
            $p_mo_ta_cn = $request->get('MO_TA_CN');
            $p_ghi_chu_cn = $request->get('GHI_CHU_CN');
            $p_tt_cn = $request->get('TRANG_THAI_CN');
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':p_ma_cn',$p_ma_cn);
            $stmt->bindParam(':p_ten_cn',$p_ten_cn);
            $stmt->bindParam(':p_mo_ta_cn',$p_mo_ta_cn, PDO::PARAM_STR, 200);
            $stmt->bindParam(':p_ghi_chu_cn',$p_ghi_chu_cn, PDO::PARAM_STR, 100);
            $stmt->bindParam(':p_tt_cn',$p_tt_cn);
            $stmt->bindParam(':result',$result);
            // return response()->json($stmt, 200);
            $stmt->execute();
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
