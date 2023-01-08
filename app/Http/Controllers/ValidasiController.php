<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ValidasiOlimpiade;
use App\Models\CbtUserGrub;
use App\Models\DetailItem;
use App\Models\Transaksi;
use App\Models\CbtUser;
use DataTables;
use Validator;
use Mail;
use Exception;

class ValidasiController extends Controller
{
    public function pendaftaran()
    {
        $grub = CbtUserGrub::all();

        return view('validasi.pendaftaran', compact(['grub']));
    }

    public function listTerdaftar(Request $request)
    {
        if($request->ajax()) {
            $options = [
                'grub_id' => $request->grub_id,
                'tes_id' => $request->tes_id,
            ];
            $data = DetailItem::listTerdaftar($options);
            $data = DataTables::of($data)->addIndexColumn()->make(true);

            return $data;
        }
    }

    public function validasi(Request $request)
    {
        if($request->ajax()) {
            $validateData = Validator::make($request->all(), [
                'email'     => 'required|email',
                'olimpiade' => 'required',
            ]);

            if ($validateData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'validation error',
                ], 405);
            }

            $email = $request->email;
            $olimpiade = $request->olimpiade;
            $datetime = date("Y-m-d H:i:s");

            $check = CbtUser::check($email)->first();
            $max = Transaksi::max('order_id');
            $order_id = $max + 1;

            $input = [
                'order_id' => $order_id,
                'gross_amount' => 0,
                'payment_type' => 'syarat & ketentuan',
                'bank' => 'admin',
                'transaction_status' => 'settlement',
                'transaction_time' => $datetime,
            ];
            Transaksi::create($input);

            foreach($olimpiade as $item_id) {
                $input = [
                    'order_id' => $order_id,
                    'user_id' => $check->user_id,
                    'item_id' => $item_id,
                ];
                DetailItem::create($input);
            }

            $email = strip_tags($request->email);
            $email = rtrim($email, ",");
            $email = explode(",", $email);

            $data = [
                'title' => 'Validasi Olimpiade - GYPEM 2023',
                'olimpiade' => 'SCIENCELISH'
            ];

            $mail = trim($email);
            try {
                Mail::to($mail)->send(new ValidasiOlimpiade($data));
            } catch (Exeception $error) {
                // $data = [
                //     'title' => 'Gagal Kirim ke '.$mail.' - GYPEM 2023',
                //     'olimpiade' => 'SCIENCELISH'
                // ];
                // Mail::to("adit.asyhari16@gmail.com")->send(new ValidasiOlimpiade($data));
            }

            return response()->json([
                'success' => true,
                'message' => 'Success Validasi',
            ], 200);
        }
    }
}
