<?php

namespace App\Http\Controllers;
use App\Mail\InvoiceClaimMail;
use App\Models\ClaimUser;
use App\Models\ClaimUserDetail;
use Validator;
use Exception;
use DataTables;
use Mail;
use PDF;
use DB;

use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index()
    {
        return view('user.claim');
    }
    
    public function paket()
    {
        $propinsi = DB::table('tm_propinsi')->orderBy('nama_propinsi', 'asc')->get();
        $paket = DB::table('tm_paket')->get();
        $grub = DB::table('cbt_user_grup')->get();
        return view('user.claim-paket', compact('propinsi', 'paket', 'grub'));
    }

    public function piagam()
    {
        $propinsi = DB::table('tm_propinsi')->orderBy('nama_propinsi', 'asc')->get();
        $grub = DB::table('cbt_user_grup')->get();
        return view('user.claim-piagam', compact('propinsi', 'grub'));
    }

    public function medali()
    {
        $propinsi = DB::table('tm_propinsi')->orderBy('nama_propinsi', 'asc')->get();
        $grub = DB::table('cbt_user_grup')->get();
        return view('user.claim-medali', compact('propinsi', 'grub'));
    }

    public function listData(Request $request)
    {
        if($request->ajax()) {
            $status = $request->filter_status;
            $olimpiade = DB::table('cbt_konfigurasi')->where('konfigurasi_kode', 'olimpiade_aktif')->pluck('konfigurasi_isi')->first();
            $data = ClaimUser::with('detailClaim')->where('olimpiade', $olimpiade);

            if($status !== "" && $status !== null) {
                $data->where('status', $status);
            }

            $result = $data->orderBy('id', 'desc')->get();
            $data = DataTables::of($result)->addIndexColumn()->make(true);

            return $data;
        }
    }

    public function listDataPaket(Request $request)
    {
        if($request->ajax()) {
            $grub = $request->filter_grub;
            $id_propinsi = $request->filter_propinsi;
            $paket = $request->filter_paket;
            $olimpiade = DB::table('cbt_konfigurasi')->where('konfigurasi_kode', 'olimpiade_aktif')->pluck('konfigurasi_isi')->first();
            $data = ClaimUserDetail::select(
                'claim_user_detail.*',
                'claim_user.nama',
                'claim_user.wa',
                'claim_user.email',
                'claim_user.alamat',
                'cbt_user_grup.grup_nama',
                // 'cbt_user.user_firstname',
                'cbt_user.nama_sekolah',
                'tm_propinsi.nama_propinsi',
            )
            ->leftJoin('claim_user', 'claim_user.id', '=', 'claim_user_detail.claim_id')
            ->leftJoin('cbt_user', 'cbt_user.user_id', '=', 'claim_user.user_id')
            ->leftJoin('tm_propinsi', 'cbt_user.id_propinsi', '=', 'tm_propinsi.id_propinsi')
            ->leftJoin('cbt_user_grup', 'cbt_user.user_grup_id', '=', 'cbt_user_grup.grup_id')
            ->where('claim_user.status', 1)
            ->where('claim_user.olimpiade', $olimpiade)
            ->when($paket, fn ($sql, $paket) => $sql->where('paket', $paket))
            ->when($grub, fn ($sql, $grub) => $sql->where('cbt_user_grup.grup_id', $grub))
            ->when($id_propinsi, fn ($sql, $id_propinsi) => $sql->where('tm_propinsi.id_propinsi', $id_propinsi))
            ->orderBy('claim_user_detail.id', 'desc')
            ->get();

            $data = DataTables::of($data)->addIndexColumn()->make(true);

            return $data;
        }
    }

    public function listDataPiagam(Request $request)
    {
        if($request->ajax()) {
            $grub = $request->filter_grub;
            $id_propinsi = $request->filter_propinsi;
            $olimpiade = DB::table('cbt_konfigurasi')->where('konfigurasi_kode', 'olimpiade_aktif')->pluck('konfigurasi_isi')->first();
            $data = ClaimUserDetail::select(
                'claim_user_detail.*',
                'claim_user.nama',
                'claim_user.wa',
                'claim_user.email',
                'cbt_user_grup.grup_nama',
                // 'cbt_user.user_firstname',
                'cbt_user.nama_sekolah',
                'tm_propinsi.nama_propinsi',
            )
            ->leftJoin('claim_user', 'claim_user.id', '=', 'claim_user_detail.claim_id')
            ->leftJoin('cbt_user', 'cbt_user.user_id', '=', 'claim_user.user_id')
            ->leftJoin('tm_propinsi', 'cbt_user.id_propinsi', '=', 'tm_propinsi.id_propinsi')
            ->leftJoin('cbt_user_grup', 'cbt_user.user_grup_id', '=', 'cbt_user_grup.grup_id')
            ->where('claim_user.status', 1)
            ->where('claim_user.olimpiade', $olimpiade)
            ->whereIn('paket', ['b','c','bonus'])
            ->when($grub, fn ($sql, $grub) => $sql->where('cbt_user_grup.grup_id', $grub))
            ->when($id_propinsi, fn ($sql, $id_propinsi) => $sql->where('tm_propinsi.id_propinsi', $id_propinsi))
            ->orderBy('claim_user_detail.id', 'desc')
            ->get();

            $data = DataTables::of($data)->addIndexColumn()->make(true);

            return $data;
        }
    }

    public function listDataMedali(Request $request)
    {
        if($request->ajax()) {
            $grub = $request->filter_grub;
            $id_propinsi = $request->filter_propinsi;
            $olimpiade = DB::table('cbt_konfigurasi')->where('konfigurasi_kode', 'olimpiade_aktif')->pluck('konfigurasi_isi')->first();
            $data = ClaimUserDetail::select(
                'claim_user_detail.*',
                'claim_user.nama',
                'claim_user.wa',
                'claim_user.email',
                'cbt_user_grup.grup_nama',
                'cbt_user.nama_sekolah',
                'tm_propinsi.nama_propinsi',
                'claim_user.alamat',
                'claim_user.note',
            )
            ->leftJoin('claim_user', 'claim_user.id', '=', 'claim_user_detail.claim_id')
            ->leftJoin('cbt_user', 'cbt_user.user_id', '=', 'claim_user.user_id')
            ->leftJoin('tm_propinsi', 'cbt_user.id_propinsi', '=', 'tm_propinsi.id_propinsi')
            ->leftJoin('cbt_user_grup', 'cbt_user.user_grup_id', '=', 'cbt_user_grup.grup_id')
            ->where('claim_user.status', 1)
            ->where('claim_user.olimpiade', $olimpiade)
            ->whereIn('paket', ['c','bonus'])
            ->when($grub, fn ($sql, $grub) => $sql->where('cbt_user_grup.grup_id', $grub))
            ->when($id_propinsi, fn ($sql, $id_propinsi) => $sql->where('tm_propinsi.id_propinsi', $id_propinsi))
            ->orderBy('claim_user_detail.id', 'desc')
            ->get();

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
            $email = $claim->email;
            $claim->update([
                'status' => 1
            ]);

            try {
                $detailClaim = ClaimUserDetail::select(
                            'p.nama_paket',
                            'p.harga',
                            'p.deskripsi'
                        )
                        ->leftJoin("tm_paket as p", 'p.nama_paket', '=', 'claim_user_detail.paket')
                        ->where('claim_id', $claim->id)
                        ->get();

                $data = [
                    'nama' => $claim->nama,
                    'total' => number_format($claim->total, 0, ".", "."),
                    'subtotal' => number_format($claim->item, 0, ".", "."),
                    'diskon' => number_format($claim->discount_claim, 0, ".", "."),
                    'ongkir' => number_format($claim->ongkir, 0, ".", "."),
                    'detailClaim' => $detailClaim
                ];
                
                Mail::to($email)->send(new InvoiceClaimMail($data));

                $message = "Berhasil validasi dan invoice BERHASIL dikirim ke email user.";
            } catch (Exception $e) {
                $message = "Berhasil validasi dan invoice GAGAL dikirim ke email user.";
            }
            
            return response()->json([
                'success' => true,
                'message' => $message
            ], 200);
        }
    }

    public function total(Request $request)
    {
        if($request->ajax()) {
            $olimpiade = DB::table('cbt_konfigurasi')->where('konfigurasi_kode', 'olimpiade_aktif')->pluck('konfigurasi_isi')->first();
            $total_user_valid = ClaimUser::where('status', 1)->where('olimpiade', $olimpiade)->count();
            $total_uang_valid = ClaimUser::where('status', 1)->where('olimpiade', $olimpiade)->sum('total');
            $total_user_reject = ClaimUser::where('status', 2)->where('olimpiade', $olimpiade)->count();
            $total_uang_reject = ClaimUser::where('status', 2)->where('olimpiade', $olimpiade)->sum('total');
            $total_user_pending = ClaimUser::where('status', 0)->where('olimpiade', $olimpiade)->count();
            $total_uang_pending = ClaimUser::where('status', 0)->where('olimpiade', $olimpiade)->sum('total');
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

    public function cetakAlamatClaim(Request $request)
    {
        $grub = null;
        $provinsi = null;
        if($request->grub) {
            $grub = $request->grub;
        }

        if($request->provinsi) {
            $provinsi = $request->provinsi;
        }

        $olimpiade = DB::table('cbt_konfigurasi')->where('konfigurasi_kode', 'olimpiade_aktif')->pluck('konfigurasi_isi')->first();
        $list = ClaimUserDetail::select(
            'claim_user.nama',
            'claim_user.wa',
            'tm_kotakab.kotakab',
            'tm_propinsi.nama_propinsi',
            'tm_kecamatan.nama_kecamatan',
            'claim_user.alamat',
        )
        ->leftJoin('claim_user', 'claim_user.id', '=', 'claim_user_detail.claim_id')
        ->leftJoin('cbt_user', 'cbt_user.user_id', '=', 'claim_user.user_id')
        ->leftJoin('tm_kecamatan', 'claim_user.id_kecamatan', '=', 'tm_kecamatan.id_kecamatan')
        ->leftJoin('tm_kotakab', 'claim_user.id_kotakab', '=', 'tm_kotakab.id_kotakab')
        ->leftJoin('tm_propinsi', 'claim_user.id_propinsi', '=', 'tm_propinsi.id_propinsi')
        ->leftJoin('cbt_user_grup', 'cbt_user.user_grup_id', '=', 'cbt_user_grup.grup_id')
        ->where('claim_user.status', 1)
        ->where('claim_user.olimpiade', $olimpiade)
        ->where('paket', '!=', 'a')
        ->when($grub, fn ($sql, $grub) => $sql->where('cbt_user_grup.grup_id', $grub))
        ->when($provinsi, fn ($sql, $provinsi) => $sql->where('tm_propinsi.id_propinsi', $provinsi))
        ->get();

        $data = ['list' => $list];

        $pdf = PDF::loadView('pdf.alamat', $data);
        $pdf->setPaper('A4');
        return $pdf->stream();
    }

}
