<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CustomerController extends Controller
{
    public function CallFunction($p_id_khach_hang, $p_ten_kh, $p_dia_chi_kh, $p_sdt_kh, $p_nguoi_dai_dien, $p_trang_thai_kh, $p_action)
    {
        $sql = "DECLARE
            p_id_khach_hang number(10);
            p_ten_kh varchar(200);
            p_dia_chi_kh varchar(200);
            p_sdt_kh varchar(200);
            p_nguoi_dai_dien varchar(200);
            p_trang_thai_kh number(1);
            p_action number(1);
        BEGIN
            :result := THEM_CAPNHAT_KH(:p_ten_kh,:p_dia_chi_kh,:p_sdt_kh,:p_nguoi_dai_dien,:p_trang_thai_kh, :p_action);
        END;";
       
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':p_id_khach_hang',$p_id_khach_hang);
        $stmt->bindParam(':p_ten_kh',$p_ten_kh);
        $stmt->bindParam(':p_dia_chi_kh',$p_dia_chi_kh);
        $stmt->bindParam(':p_sdt_kh',$p_sdt_kh);
        $stmt->bindParam(':p_nguoi_dai_dien',$p_nguoi_dai_dien);
        $stmt->bindParam(':p_trang_thai_kh',$p_trang_thai_kh);
        $stmt->bindParam(':p_action',$p_action);
        $stmt->bindParam(':result',$result);
        // return response()->json($stmt, 200);
        $stmt->execute();
        return $result;
    }
    public function index(Request $request)
    {
        if($request->has('api_token'))
        {
            //CHECK TOKEN ADN RULE
            $customers = DB::select("SELECT * FROM TB_KH");
            return response()->json([
                'success' => true,
                'message' => 'Danh sách khách hàng',
                'results' => $customers
            ], 200);
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
                'TEN_KH' => 'required|max:100',
                'DIA_CHI_KH' => 'required|max:255',
                'SDT_KH' => 'required|max:14',
                'NGUOI_DAI_DIEN_KH' => 'required|max:100',
                'TRANG_THAI_KH' => 'required|max:1'
            ]);    
            //CHECK TOKEN
            if($validate)
            {
               
                $p_id_khach_hang = 0;
                $p_ten_kh = $request->get('TEN_KH');
                $p_dia_chi_kh = $request->get('DIA_CHI_KH');
                $p_sdt_kh = $request->get('SDT_KH');
                $p_nguoi_dai_dien = $request->get('NGUOI_DAI_DIEN_KH');
                $p_trang_thai_kh = $request->get('TRANG_THAI_KH');
                $p_action = 1;
                $result = $this->CallFunction($p_id_khach_hang, $p_ten_kh, $p_dia_chi_kh, $p_sdt_kh, $p_nguoi_dai_dien, $p_trang_thai_kh, $p_action);
                return response()->json([
                    'success' => true,
                    'message' => 'Thêm khách hàng mới thành công',
                    'result' => '',
                    'status' => 200
                ], 200);
            }
            return response()->json([
                'success' => false,
                'message' => 'Lỗi tham số',
                'result' => '',
                'status' => 400
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Bạn không có quyền để tạo khách hàng từ hệ thống',
            'result' => '',
            'status' => 401
        ], 200);
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
        if($request->has('api_token'))
        {
            $validate = $this->validate($request,[
                'TEN_KH' => 'required|max:100',
                'DIA_CHI_KH' => 'required|max:255',
                'SDT_KH' => 'required|max:14',
                'NGUOI_DAI_DIEN_KH' => 'required|max:100',
                'TRANG_THAI_KH' => 'required|max:1'
            ]);    
            //CHECK TOKEN
            if($validate)
            {
               
                $p_id_khach_hang = $id;
                $p_ten_kh = $request->get('TEN_KH');
                $p_dia_chi_kh = $request->get('DIA_CHI_KH');
                $p_sdt_kh = $request->get('SDT_KH');
                $p_nguoi_dai_dien = $request->get('NGUOI_DAI_DIEN_KH');
                $p_trang_thai_kh = $request->get('TRANG_THAI_KH');
                $p_action = 2;
                $result = $this->CallFunction($p_id_khach_hang, $p_ten_kh, $p_dia_chi_kh, $p_sdt_kh, $p_nguoi_dai_dien, $p_trang_thai_kh, $p_action);
                return response()->json([
                    'success' => true,
                    'message' => 'Cập nhật khách hàng mới thành công',
                    'result' => '',
                    'status' => 200
                ], 200);
            }
            return response()->json([
                'success' => false,
                'message' => 'Lỗi tham số',
                'result' => '',
                'status' => 400
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Bạn không có quyền để tạo khách hàng từ hệ thống',
            'result' => '',
            'status' => 401
        ], 200);
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
