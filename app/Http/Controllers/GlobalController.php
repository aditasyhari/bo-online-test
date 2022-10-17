<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TokenMail;
use Validator;
use Mail;
use Exception;

class GlobalController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function blastEmail() 
    {
        return view('email.blast-email');
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
}
