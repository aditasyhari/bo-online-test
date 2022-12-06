<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use DB;

class GeneratorController extends Controller
{
    public function piagam(Request $request) 
    {
        $propinsi = DB::table('tm_propinsi')->orderBy('nama_propinsi', 'asc')->get();
        return view('generator.piagam', compact('propinsi'));
    }

    public function sertifikat(Request $request) 
    {
        return view('generator.sertifikat');
    }

    public function generatePiagam(Request $request)
    {
        if($request->ajax()) {
            $nama       = strtoupper($request->nama);
            $sekolah    = strtoupper($request->sekolah);
            $provinsi   = strtoupper($request->propinsi);
            $olimpiade  = strtoupper($request->olimpiade);
            $medali     = strtolower($request->medali);

            $img_name = time().'-'.$nama.'-'.$olimpiade.'.jpg';
            $img = Image::make(public_path("images/piagam/template/$medali.jpg"));  
            $img->text($nama, 1570, 990, function($font) {  
                $font->file(public_path('font/arial.ttf'));  
                $font->size(60);  
                $font->color('#000000');  
                $font->align('left');  
                $font->valign('left');  
            }); 
            $img->text($sekolah, 1570, 1065, function($font) {  
                $font->file(public_path('font/arial.ttf'));  
                $font->size(60);  
                $font->color('#000000');  
                $font->align('left');  
                $font->valign('left');  
            });  
            $img->text($provinsi, 1570, 1140, function($font) {  
                $font->file(public_path('font/arial.ttf'));  
                $font->size(60);  
                $font->color('#000000');  
                $font->align('left');  
                $font->valign('left');  
            }); 
            $img->text($olimpiade, 1950, 1425, function($font) {  
                $font->file(public_path('font/arial.ttf'));  
                $font->size(90);  
                $font->color('#000000');  
                $font->align('center');  
                $font->valign('center');  
            });    
    
            $img->save(public_path('images/piagam/generate/'.$img_name)); 
    
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Generate',
                'data'    => $img_name
            ], 200);
        }
    }

    public function generateSertifikat(Request $request)
    {
        if($request->ajax()) {
            $nama       = strtoupper($request->nama);
            $olimpiade  = strtoupper($request->olimpiade);

            $nama = strtolower($request->nama);
            $nama = ucwords($nama);
            $img_name = time().'-'.$nama.'-'.$olimpiade.'.jpg';
            $img = Image::make(public_path('images/sertifikat/template/certificate-osn.jpg'));  
            $img->text($nama, 1930, 1250, function($font) {  
                $font->file(public_path('font/brush-regular.ttf'));  
                $font->size(230);  
                $font->color('#000000');  
                $font->align('center');  
                $font->valign('center');  
            });  
            $img->text($olimpiade, 1950, 1570, function($font) {  
                $font->file(public_path('font/arial-bold.ttf'));  
                $font->size(60);  
                $font->color('#000000');  
                $font->align('center');  
                $font->valign('center');  
            }); 
    
            $img->save(public_path('images/sertifikat/generate/'.$img_name)); 
    
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Generate',
                'data'    => $img_name
            ], 200);
        }
    }

}
