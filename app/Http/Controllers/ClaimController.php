<?php

namespace App\Http\Controllers;
use App\Models\ClaimUser;
use App\Models\ClaimUserDetail;
use Validator;
use Exception;
use DataTables;
use DB;

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

    public function total(Request $request)
    {
        if($request->ajax()) {
            $total_user_valid = ClaimUser::where('status', 1)->count();
            $total_uang_valid = ClaimUser::where('status', 1)->sum('total');
            $total_user_reject = ClaimUser::where('status', 2)->count();
            $total_uang_reject = ClaimUser::where('status', 2)->sum('total');
            $total_user_pending = ClaimUser::where('status', 0)->count();
            $total_uang_pending = ClaimUser::where('status', 0)->sum('total');
            $data['pending'] = [
                'total_user' => $total_user_pending,
                'total_uang' => $total_uang_pending
            ];
            $data['valid'] = [
                'total_user' => $total_user_valid,
                'total_uang' => $total_uang_valid
            ];
            $data['reject'] = [
                'total_user' => $total_user_reject,
                'total_uang' => $total_uang_reject
            ];

            return response()->json([
                'success' => true,
                'message' => 'Berhasil get data',
                'data' => $data
            ], 200);
        }
    }

    public function update(Request $request)
    {
        if($request->ajax()) {
            DB::beginTransaction();
            try {
                $validateData = Validator::make($request->all(), [
                    // 'add_item'      => 'required',
                    'alamat'        => 'required',
                    'id'            => 'required'
                ]);
    
                if ($validateData->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => $validateData->errors()
                    ], 401);
                }

                $id = $request->id;
                $claim = ClaimUser::find($id);
                $alamat = $request->alamat;
                $note = $request->note;
                // $item = $request->add_item;
                // $ongkir = 0;
                // $harga_item = 0;
    
                // foreach($item as $i) {
                //     switch($i) {
                //         case 'a':
                //             $harga_item += 50000; 
                //             break;
                //         case 'b':
                //             $ongkir = $claim->ongkir;
                //             $harga_item += 95000; 
                //             break;
                //         case 'c':
                //             $ongkir = $claim->ongkir;
                //             $harga_item += 145000; 
                //             break;
                //         case 'd':
                //             $ongkir = $claim->ongkir;
                //             $harga_item += 160000; 
                //             break;
                //         case 'bonus':
                //             $ongkir = $claim->ongkir;
                //             $harga_item += 325000; 
                //             break;
                //     }
    
                //     ClaimUserDetail::create([
                //         'claim_id' => $id,
                //         'paket' => $i,
    
                //     ]);
                // }
    
                $update = [
                    'alamat' => $alamat,
                    'note' => $note,
                ];
                
                $claim->update($update);
    
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Update Data'
                ], 200);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'message' => 'error '.$e->getMessage()
                ], 500);
            }
        }
    }

}
