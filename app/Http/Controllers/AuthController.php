<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Validator;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        if($request->ajax()) {
            $validateData = Validator::make($request->all(), [
                'username'    => 'required',
                'password'    => 'required',
            ]);

            if ($validateData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validateData->errors()
                ], 401);
            }

            $username = $request->username;
            $password = sha1($request->password);
            $user = User::where('username', $username)->first();

            if($user) {
                if($password == $user->password) {
                    Auth::login($user);

                    return response()->json([
                        'success' => true,
                        'message' => 'Berhasil Login'
                    ], 200);
                }

                return response()->json([
                    'success' => false,
                    'message' => 'Password salah'
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 200);
        }
    }

    public function logout(Request $request)
    {
        if($request->ajax()) {
            Auth::logout();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil keluar'
            ], 200);
        }
    }
}
