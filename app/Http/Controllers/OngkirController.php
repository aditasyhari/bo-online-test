<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DataTables;
use Exception;
use DB;

class OngkirController extends Controller
{
    public function index()
    {
        return view("ongkir.index");
    }

    public function listData(Request $request)
    {
        if($request->ajax()) {
            $data = DB::table('tm_propinsi')->orderBy('nama_propinsi', 'asc')->get();
            $data = DataTables::of($data)->addIndexColumn()->make(true);

            return $data;
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            $id = $request->id;
            $ongkir = DB::table('tm_propinsi')->where('id_propinsi', $id);
            $ongkir->update([
                'ongkir' => intval(trim(preg_replace('/\D/', '', $request->ongkir)))
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Berhasil update ongkir'
            ], 200);
        }
    }
}
