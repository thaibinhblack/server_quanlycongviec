<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
                n NUMBER;
            BEGIN
                n:=THEM_TK_TB_ND(:p_username,:p_password);
            END;";
            $pdo = DB::getPdo();
            // $stmt = $pdo->prepare($sql);
            // $stmt->bindParam(':p_username',$username);
            // $stmt->bindParam(':p_password',$password);
            // $resignter =  $stmt->execute();
            // return response()->json($stmt, 200);
            $resignter = $pdo->prepare("select THEM_TK_TB_ND('thaibinh161','$2y$10$6M.ik7pD3JCJAyMJ2Tndh.F3JFdqrpL5N4OCBUfIT/6nbgvwEHqKG') from dual;");
            return response()->json($resignter, 200);
            if($resignter[0]->result == 1)
            {
                $token =  $token = Str::random(100);
                DB::select("call UPDATE_TOKEN('$username','$token')");
                return response()->json([
                    'success' => true,
                    'message' => 'Đăng ký thành công',
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
