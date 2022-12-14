<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\GeneratorController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\TesController;
use App\Http\Controllers\ValidasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return redirect('dashboard');});
Route::get('auth/login', function () {return view('auth.login');})->name('login');
Route::post('auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth'], function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);

    // global
    Route::get('dashboard', [GlobalController::class, 'dashboard']);
    Route::get('list-olimpiade', [GlobalController::class, 'olimpiade']);
    Route::get('check-user', [GlobalController::class, 'checkUser']);

    // claim
    Route::get('claim-all', [ClaimController::class, 'index']);
    Route::get('claim-piagam', [ClaimController::class, 'piagam']);
    Route::get('claim-medali', [ClaimController::class, 'medali']);
    Route::get('claim-paket', [ClaimController::class, 'paket']);
    Route::post('claim-data', [ClaimController::class, 'listData']);
    Route::post('claim-data-paket', [ClaimController::class, 'listDataPaket']);
    Route::get('claim-data-paket/cetak-alamat', [ClaimController::class, 'cetakAlamatClaim']);
    Route::post('claim-data-piagam', [ClaimController::class, 'listDataPiagam']);
    Route::post('claim-data-medali', [ClaimController::class, 'listDataMedali']);

    Route::post('claim-total', [ClaimController::class, 'total']);
    Route::post('claim-update-data', [ClaimController::class, 'update']);
    Route::post('claim-reject', [ClaimController::class, 'reject']);
    Route::post('claim-validasi', [ClaimController::class, 'validasi']);

    // generator
    Route::get('generator-piagam', [GeneratorController::class, 'piagam']);
    Route::get('generator-sertifikat', [GeneratorController::class, 'sertifikat']);
    Route::post('generator-piagam', [GeneratorController::class, 'generatePiagam']);
    Route::post('generator-sertifikat', [GeneratorController::class, 'generateSertifikat']);

    // data tes
    Route::get('data-tes/hasil-tes', [TesController::class, 'hasilTes']);
    Route::get('data-tes/hasil-tes/export', [TesController::class, 'export']);
    Route::post('data-tes/hasil-tes/list', [TesController::class, 'hasilTesList']);

     // validasi
     Route::get('validasi/pendaftaran', [ValidasiController::class, 'pendaftaran']);
     Route::post('validasi/pendaftaran', [ValidasiController::class, 'validasi']);
     Route::post('validasi/pendaftaran/list', [ValidasiController::class, 'listTerdaftar']);

    // blast email
    Route::get('blast-email', [GlobalController::class, 'blastEmail']);
    Route::post('blast-email/blast-email-token', [GlobalController::class, 'blastEmailToken']);
    Route::post('blast-email/blast-email-hasil-olimpiade', [GlobalController::class, 'blastEmailHasil']);
    
    // setting
    Route::get('setting/user-bo', [UserController::class, 'userBo']);
    Route::post('setting/user-bo/list', [UserController::class, 'userBoList']);
    Route::post('setting/user-bo/add', [UserController::class, 'addUserBo']);
    Route::post('setting/user-bo/detail', [UserController::class, 'detailUserBo']);
    Route::post('setting/user-bo/update', [UserController::class, 'updateUserBo']);
    Route::post('setting/user-bo/delete', [UserController::class, 'deleteUserBo']);

    Route::get('setting/ongkir', [OngkirController::class, 'index']);
    Route::post('setting/ongkir/list', [OngkirController::class, 'listData']);
    Route::post('setting/ongkir/update', [OngkirController::class, 'update']);

    Route::get('setting/paket', [PaketController::class, 'index']);
    Route::post('setting/paket/list', [PaketController::class, 'listData']);
    Route::post('setting/paket/update', [PaketController::class, 'update']);
    Route::post('setting/paket/flag-update', [PaketController::class, 'updateFlag']);

    Route::get('setting/user-cbt', [UserController::class, 'user']);
    Route::get('setting/user-cbt/discount-multiple', [UserController::class, 'userDiscount']);
    Route::get('setting/user-cbt/remove-discount', [UserController::class, 'removeDiscount']);
    Route::post('setting/user-cbt/list', [UserController::class, 'userCbtList']);
    Route::post('setting/user-cbt/add', [UserController::class, 'addUserCbt']);
    Route::post('setting/user-cbt/detail', [UserController::class, 'detailUserCbt']);
    Route::post('setting/user-cbt/update', [UserController::class, 'updateUserCbt']);
    Route::post('setting/user-cbt/update-discount', [UserController::class, 'updateDiscountUser']);
    Route::post('setting/user-cbt/delete', [UserController::class, 'deleteUserCbt']);
});