<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportHasilTes;
use App\Models\CbtTes;
use App\Models\CbtTesUser;
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
            // $tes_id = 46;

            $result = [];
            if($tes_id) {
                $result = CbtTesUser::hasilTes($tes_id, $order);
            }

            $data = DataTables::of($result)->make(true);

            return $data;
        }
    }

    public function export(Request $request)
    {
        $tes_id = $request->tes_id;
        $order = $request->order;

        if($tes_id) {
            // $data = CbtTesUser::hasilTesExport($tes_id, $order);
            // dd($data);
            return Excel::download(new ExportHasilTes($tes_id, $order), time().'-hasil-tes.xlsx');
        }

        return back();
    }
}
