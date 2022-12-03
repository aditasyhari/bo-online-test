<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DataTables;
use Exception;
use DB;

class PaketController extends Controller
{
    public function index()
    {
        return view("paket.index");
    }

    public function listData(Request $request)
    {
        if($request->ajax()) {
            $data = DB::table('tm_paket')->get();
            $data = DataTables::of($data)->addIndexColumn()->make(true);

            return $data;
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            $id = $request->id;
            $paket = DB::table('tm_paket')->where('id', $id);
            $paket->update([
                'harga' => intval(trim(preg_replace('/\D/', '', $request->harga))),
                'deskripsi' => $request->deskripsi,
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Berhasil update paket'
            ], 200);
        }
    }

    public function updateFlag(Request $request)
    {
        if($request->ajax()) {
            $id = $request->id;
            $flag = 1;
            $data = DB::table('tm_paket')->where('id', $id)->first();
            if($data->flag) {
                $flag = 0;
            }

            DB::table('tm_paket')->where('id', $id)->update([
                'flag' => $flag
            ]);

            return response()->json([
                'success' => true,
                'message' => 'success'
            ], 200);
        }
    }

}
