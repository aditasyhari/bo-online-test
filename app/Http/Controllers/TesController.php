<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CbtTes;
Use DataTables;
Use Validator;
Use Exception;
use DB;

class TesController extends Controller
{
    public function hasilTes()
    {
        $tes = CbtTes::select('tes_id', 'tes_nama')->orderBy('tes_id', 'desc')->get();
        return view('tes.hasil-tes', compact('tes'));
    }

    public function hasilTesList(Request $request)
    {
        if($request->ajax()) {
            $order = $request->order;
            $tes_id = $request->tes_id;

            $result = [];
            if($tes_id) {
                $result = CbtTes::hasilTes($tes_id, $order);
            }

            $data = DataTables::of($result)->addIndexColumn()->make(true);

            return $data;
        }
    }
}
