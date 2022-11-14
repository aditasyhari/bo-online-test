<?php

namespace App\Http\Controllers;
use App\Models\ClaimUser;
use DataTables;

use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index()
    {
        return view('user.claim');
    }

    public function listData(Request $request)
    {
        if($request->ajax()) {
            $data = ClaimUser::with('detailClaim')->orderBy('id', 'desc')->get();
            $data = DataTables::of($data)->addIndexColumn()->make(true);

            return $data;
        }
    }

    public function reject(Request $request)
    {
        if($request->ajax()) {
            $id = $request->id;
            $claim = ClaimUser::find($id);
            $claim->update([
                'status' => 2
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil reject'
            ], 200);
        }
    }

    public function validasi(Request $request)
    {
        if($request->ajax()) {
            $id = $request->id;
            $claim = ClaimUser::find($id);
            $claim->update([
                'status' => 1
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Berhasil validasi'
            ], 200);
        }
    }

}
