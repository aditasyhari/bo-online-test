<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TokenMail;
use App\Mail\ResultMail;
use App\Models\CbtTesUser;
use App\Models\ClaimUser;
use App\Models\CbtTes;
use App\Models\CbtUser;
use App\Models\CbtUserGrub;
use App\Models\Paket;
use Validator;
use Mail;
use Exception;

class GlobalController extends Controller
{
    public function dashboard()
    {
        $latestUser = CbtUser::latestUser(9)->get();
        $userClaim = ClaimUser::userClaim()->count();
        $olimpiade = count(ClaimUser::totalOlimpiade()->pluck('olimpiade'));
        $mapel = CbtTes::count();
        $users = CbtUser::count();
        $topUserClaim = ClaimUser::topClaim()->get();
        $paket = Paket::dataChart()->get();
        $grub = CbtUserGrub::dataChart()->get();
        $chartPaket = $paket->pluck('total');
        $chartGrub = $grub->pluck('total');
        $totalPaketClaim = $paket->sum('total');
        $totalUserGrub = $grub->sum('total');
        $persentPaket = [
            'a' => intval(($paket[0]['total'] / $totalPaketClaim) * 100),
            'b' => intval(($paket[1]['total'] / $totalPaketClaim) * 100),
            'c' => intval(($paket[2]['total'] / $totalPaketClaim) * 100),
            'd' => intval(($paket[3]['total'] / $totalPaketClaim) * 100),
            'bonus' => intval(($paket[4]['total'] / $totalPaketClaim) * 100)
        ];
        $persentGrub = [
            'sd' => intval(($grub[2]['total'] / $totalUserGrub) * 100),
            'smp' => intval(($grub[0]['total'] / $totalUserGrub) * 100),
            'sma' => intval(($grub[1]['total'] / $totalUserGrub) * 100),
            'universitas' => intval(($grub[3]['total'] / $totalUserGrub) * 100)
        ];

        return view('dashboard', compact('userClaim', 'olimpiade', 'mapel', 'users', 'topUserClaim', 'chartPaket', 'chartGrub', 'persentPaket', 'persentGrub', 'latestUser'));
    }

    public function blastEmail() 
    {
        return view('email.blast-email');
    }

    public function olimpiade(Request $request)
    {
        if($request->ajax()) {
            $grub_id = $request->grub_id;
            $data = CbtTes::list($grub_id);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil Get Data',
                'data' => $data
            ], 200);
        }
    }

    public function checkUser(Request $request)
    {
        if($request->ajax()) {
            $validateData = Validator::make($request->all(), [
                'email'     => 'nullable|email',
            ]);

            if ($validateData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => '',
                    'data' => 0
                ], 200);
            }

            $email = $request->email;
            $data = CbtUser::check($email)->count();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil Get Data',
                'data' => $data
            ], 200);
        }
    }

    public function blastEmailToken(Request $request)
    {
        if($request->ajax()) {
            $validateData = Validator::make($request->all(), [
                'email'    => 'required',
                'token'    => 'required',
            ]);

            if ($validateData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validateData->errors()
                ], 401);
            }

            $token = $request->token;
            $email = strip_tags($request->email);
            $email = rtrim($email, ",");
            $email = explode(",", $email);

            $data = [
                'title' => 'Token NESO - GYPEM 2022',
                'token' => $token
            ];

            foreach($email as $mail) {
                $mail = trim($mail);
                try {
                    Mail::to($mail)->send(new TokenMail($data));
                } catch (Exeception $error) {
                    $data = [
                        'title' => 'Gagal Kirim ke '.$mail.' - GYPEM 2022',
                        'token' => $mail
                    ];
                    Mail::to("adit.asyhari16@gmail.com")->send(new TokenMail($data));

                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal Kirim Email ke '.$mail
                    ], 500);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil Kirim Token'
            ], 200);
        }
    }

    public function blastEmailHasil(Request $request)
    {
        if($request->ajax()) {
            $validateData = Validator::make($request->all(), [
                'email'     => 'nullable',
                'link'      => 'required',
                'olimpiade' => 'required',
                'grub'      => 'required',
            ]);

            if ($validateData->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validateData->errors()
                ], 401);
            }

            $link = $request->link;
            $olimpiade = $request->olimpiade;
            $grub = $request->grub;

            if($request->email) {
                $email = strip_tags($request->email);
                $email = rtrim($email, ",");
                $email = explode(",", $email);
            } else {
                $email = CbtTesUser::getUserTest(strtoupper($grub));
                // $email = "adit.asyhari16@gmail.com";
            }

            $data = [
                'title' => 'Daftar Pemenang '.$olimpiade,
                'link' => $link,
                'olimpiade' => $olimpiade
            ];

            foreach($email as $mail) {
                $mail = trim($mail);
                try {
                    Mail::to($mail)->send(new ResultMail($data));
                } catch (Exeception $error) {
                    $data['title'] = 'Gagal Kirim ke '.$mail.' - GYPEM 2022';
                    Mail::to("adit.asyhari16@gmail.com")->send(new ResultMail($data));

                    // return response()->json([
                    //     'success' => false,
                    //     'message' => 'Gagal Kirim Email ke '.$mail
                    // ], 500);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil Kirim Token'
            ], 200);
        }
    }

}
