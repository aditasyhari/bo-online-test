<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;
use App\Models\UserLevel;
use App\Models\User;
use Validator;
use DataTables;
use Hash;
use Str;

class UserController extends Controller
{
    public function userBo()
    {
        $level = UserLevel::all();

        return view('user.user-bo', compact(['level']));
    }

    public function userBoList(Request $request)
    {
        if($request->ajax()) {
            $data = User::all();
            $data = DataTables::of($data)->addIndexColumn()->make(true);

            return $data;
        }
    }

    public function detailUserBo(Request $request)
    {
        if($request->ajax()) {
            $id = $request->id;
            $data = User::find($id);

            return response()->json([
                'success' => true,
                'message' => 'success',
                'data' => $data
            ], 200);
        }
    }

    public function addUserBo(Request $request)
    {
        if($request->ajax()) {
            $validateData = Validator::make($request->all(), [
                'username'      => 'required|unique:user,username',
                'nama'          => 'required',
                'password'      => 'required|confirmed|min:5',
                'keterangan'    => 'required',
                'level'         => 'required'
            ]);

            if ($validateData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validateData->errors()
                ], 401);
            }

            User::create([
                'username'      => Str::lower($request->username),
                'nama'          => $request->nama,
                'password'      => sha1($request->password),
                'keterangan'    => $request->keterangan,
                'level'         => $request->level,
                'opsi1'         => '',
                'opsi2'         => '',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'success create user'
            ], 200);
        }
    }

    public function updateUserBo(Request $request)
    {
        if($request->ajax()) {
            $validateData = Validator::make($request->all(), [
                'nama'          => 'required',
                'keterangan'    => 'required',
                'level'         => 'required'
            ]);

            if ($validateData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validateData->errors()
                ], 401);
            }

            $user = User::find($request->id_user);
            $user->update([
                'nama'          => $request->nama,
                'keterangan'    => $request->keterangan,
                'level'         => $request->level,
                'ts'            => date("Y-m-d H:i:s")
            ]);

            return response()->json([
                'success' => true,
                'message' => 'success update user'
            ], 200);
        }
    }

    public function deleteUserBo(Request $request)
    {
        if($request->ajax()) {
            $id = $request->id;
            User::destroy($id);

            return response()->json([
                'success' => true,
                'message' => 'success delete user'
            ], 200);
        }
    }

}
