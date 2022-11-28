<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\GeneratorController;

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

    // dashboard
    Route::get('dashboard', [GlobalController::class, 'dashboard']);

    // claim
    Route::get('claim-all', [ClaimController::class, 'index']);
    Route::get('claim-epiagam', [ClaimController::class, 'epiagam']);
    Route::get('claim-medali', [ClaimController::class, 'medali']);
    Route::get('claim-paket', [ClaimController::class, 'paket']);
    Route::post('claim-data', [ClaimController::class, 'listData']);
    Route::post('claim-data-paket', [ClaimController::class, 'listDataPaket']);
    Route::post('claim-data-epiagam', [ClaimController::class, 'listDataEpiagam']);
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


    // blast email
    Route::get('blast-email', [GlobalController::class, 'blastEmail']);
    Route::post('blast-email/blast-email-token', [GlobalController::class, 'blastEmailToken']);
    Route::post('blast-email/blast-email-hasil-olimpiade', [GlobalController::class, 'blastEmailHasil']);
    
    // user
    Route::get('setting/user-bo', [UserController::class, 'userBo']);
    Route::post('setting/user-bo/list', [UserController::class, 'userBoList']);
    Route::post('setting/user-bo/add', [UserController::class, 'addUserBo']);
    Route::post('setting/user-bo/detail', [UserController::class, 'detailUserBo']);
    Route::post('setting/user-bo/update', [UserController::class, 'updateUserBo']);
    Route::post('setting/user-bo/delete', [UserController::class, 'deleteUserBo']);

    Route::get('setting/user-cbt', [UserController::class, 'user']);
    Route::post('setting/user-cbt/list', [UserController::class, 'userCbtList']);
    Route::post('setting/user-cbt/add', [UserController::class, 'addUserCbt']);
    Route::post('setting/user-cbt/detail', [UserController::class, 'detailUserCbt']);
    Route::post('setting/user-cbt/update', [UserController::class, 'updateUserCbt']);
    Route::post('setting/user-cbt/delete', [UserController::class, 'deleteUserCbt']);
});