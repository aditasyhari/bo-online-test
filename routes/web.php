<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClaimController;

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
    Route::get('claim', [ClaimController::class, 'index']);
    Route::post('claim-data', [ClaimController::class, 'listData']);
    Route::post('claim-reject', [ClaimController::class, 'reject']);
    Route::post('claim-validasi', [ClaimController::class, 'validasi']);

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