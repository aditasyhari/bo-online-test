<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;
use App\Models\UserLevel;
use App\Models\UserGroup;
use App\Models\CbtUser;
use App\Models\User;
use Validator;
use DataTables;
use Hash;
use Str;
use DB;

class UserController extends Controller
{
    public function user()
    {
        $grub = UserGroup::all();
        $propinsi = DB::table('tm_propinsi')->orderBy('nama_propinsi', 'asc')->get();

        return view('user.user-cbt', compact(['grub', 'propinsi']));
    }

    public function userDiscount(Request $request)
    {
        $data = DB::table('cbt_tes_user as ctu')
                ->select('ctu.tesuser_user_id', 'u.id_propinsi', 'p.ongkir')
                ->leftJoin('cbt_user as u', 'u.user_id', '=', 'ctu.tesuser_user_id')
                ->leftJoin('tm_propinsi as p', 'u.id_propinsi', '=', 'p.id_propinsi')
                ->whereDate('ctu.tesuser_creation_time', '2022-11-13')
                ->groupBy('ctu.tesuser_user_id', 'u.id_propinsi', 'p.ongkir')
                ->get();

        foreach($data as $d) {
            if($d->ongkir > 1000) {
                $diskon = (15*$d->ongkir)/100;
                $user = CbtUser::find($d->tesuser_user_id);
                $user->update([
                    'discount_claim' => $diskon
                ]);
            }
        }

        return 'success';
    }

    public function userCbtList(Request $request)
    {
        if($request->ajax()) {
            $grub = $request->id_grub;
            $propinsi = $request->id_propinsi;
            $data = CbtUser::select(
                'user_id',
                'user_grup_id',
                'user_name',
                'user_firstname',
                'user_password',
                'grup_nama',
                'user_email',
                'nama_sekolah',
                'nomor_hp',
                'discount_claim',
                'nama_propinsi',
                'kotakab',
            )
            ->leftJoin('tm_kotakab as k', 'k.id_kotakab', '=', 'cbt_user.id_kotakab')
            ->leftJoin('tm_propinsi as p', 'p.id_propinsi', '=', 'cbt_user.id_propinsi')
            ->leftJoin('cbt_user_grup as ug', 'ug.grup_id', '=', 'cbt_user.user_grup_id')
            ->when($grub, fn ($sql, $grub) => $sql->where('cbt_user.user_grup_id', $grub))
            ->when($propinsi, fn ($sql, $propinsi) => $sql->where('cbt_user.id_propinsi', $propinsi))
            ->orderBy('user_firstname', 'asc')
            ->get();

            $data = DataTables::of($data)->addIndexColumn()->make(true);

            return $data;
        }
    }

    public function updateDiscountUser(Request $request)
    {
        if($request->ajax()) {
            $id = $request->id_user;
            $data = CbtUser::find($id);
            $data->update([
                'discount_claim' => intval(trim(preg_replace('/\D/', '', $request->discount)))
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Berhasil update ongkir'
            ], 200);
        }
    }

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
