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
    public function index()
    {
        
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
            'PASSWORD' => 'required'
        ]);
        if($validate)
        {
            // return response()->json($request->all(), 200);
            $username = $request->get('USERNAME');
            $password = Hash::make($request->get("PASSWORD"));
            $sql = "DECLARE
            BEGIN
                :n := THEM_TK_TB_ND(:p_username,:p_password);
            END;";
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':p_username',$username);
            $stmt->bindParam(':p_password',$password);
            $stmt->bindParam(':n',$result);
            $resignter =  $stmt->execute();
            if($result== 1)
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
                    'message' => 'Đăng ký thành công',
                    'result' => $token,
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
            $check = Hash::check($request->get('PASSWORD'), $result[0]->password_nd);
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
            'result' => $token,
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
