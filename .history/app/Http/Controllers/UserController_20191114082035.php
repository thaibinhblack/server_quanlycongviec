<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            $username = $request->get('USERNAME');
            // $password = Hash::make($request->get("PASSWORD"));
            return response()->json($password, 200);
            $resignter = DB::select("SELECT RESIGNTER('$username','$password')  as result");
            
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