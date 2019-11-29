<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('api_token'))
        {
            $users = DB::select("SELECT * from TB_NGUOI_DUNG");
            return response()->json($users, 200);
        }
    }

    public function token(Request $request)
    {
        if($request->has('api_token'))
        {
            $token = $request->get('token');    
            $users = DB::select("SELECT ID_ND, USERNAME_ND from TB_NGUOI_DUNG where TOKEN_ND = ");
            return response()->json($users, 200);
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
        //
    }

    public function resignter(Request $request)
    {
        // return response()->json($request->all(), 200);
        $validate  = $this->validate($request,[
            'USERNAME' => 'required|max:25',
            'PASSWORD' => 'required',
            'ID_NHOM' => 'required'
        ]);
        if($validate)
        {
            // return response()->json($request->all(), 200);
            $username = $request->get('USERNAME');
            $password = Hash::make($request->get("PASSWORD"));
            $p_id_nhom = $request->get("ID_NHOM");
            $p_sdt = $request->has("SDT_ND") ? $request->get("SDT_ND") : '';
            $p_email = $request->has("EMAIL_ND") ? $request->get("EMAIL_ND") : '';
            $p_gt = $request->has("GOITINH_ND") ? $request->get("GIOITINH_ND") : 1;
            $p_ngaysinh = $request->has("GOITINH_ND") ? $request->get("NGAY_SINH") : '';
            $sql = "DECLARE
            BEGIN
                :n := THEM_TK_TB_ND(:p_username,:p_password, :p_id_nhom,:p_sdt, :p_email,:p_gt, :p_ngaysinh);
            END;";
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':p_username',$username);
            $stmt->bindParam(':p_password',$password);
            $stmt->bindParam(':p_id_nhom',$p_id_nhom);
            $stmt->bindParam(':p_sdt',$p_sdt);
            $stmt->bindParam(':p_email',$p_email);
            $stmt->bindParam(':p_gt',$p_gt);
            $stmt->bindParam(':p_ngaysinh',$p_ngaysinh);
            $stmt->bindParam(':n',$result);
            $resignter =  $stmt->execute();
            if($result== 1)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Đăng ký thành công',
                    'result' => $username,
                    'status' => 200
                ], 200);
            }
            return response()->json([
                'success' => false,
                'message' => 'Username đã tồn tại',
                'status' => 404
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Biến không hợp lệ',
            'status' => 400
        ], 200);
    }
    public function login(Request $request)
    {
        $validate  = $this->validate($request,[
            'USERNAME' => 'required|max:25',
            'PASSWORD' => 'required'
        ]);
        if($validate)
        {
            $username  = $request->get("USERNAME");
            $result = DB::select("SELECT PASSWORD_ND from TB_NGUOI_DUNG where USERNAME_ND = '$username'");
            if($result)
            {
                $check = Hash::check($request->get('PASSWORD'), $result[0]->password_nd);
            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Tài khoản không đúng!',
                    'status' => 200,
                    'result' => ''
                ], 200);
            }
            if($check)
            {
                $token =  $token = Str::random(100);
                $sql = "DECLARE  
                    p_token varchar2(200); 
                    token varchar2(200);                            
                BEGIN                 
                    token :=UPDATE_TOKEN_ND(:p_token,:p_username);
                END;";
                $pdo = DB::getPdo();
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':p_token',$token);
                $stmt->bindParam(':p_username',$username);
                // $stmt->bindParam(':token',$result_token);
                $stmt->execute();
                return response()->json([
                    'success' => true,
                    'message' => 'Đăng nhập thành công!',
                    'result' => $token,
                    'status' => 200
                ], 200);
            }
            return response()->json([
                'success' => false,
                'message' => 'Mật khẩu không đúng!',
                'result' =>'',
                'status' => 200
            ], 200);    
        }
        return response()->json([
            'success' => false,
            'message' => 'Biến không hợp lệ',
            'result' => '',
            'status' => 200
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
