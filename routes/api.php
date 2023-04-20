<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminCodeController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminProductsController;
use App\Http\Controllers\AdminSupervisorController;
use App\Http\Controllers\SupervisorCodeController;
use App\Http\Controllers\SupervisorCRUDController;
use App\Http\Controllers\CostomerCodeController;
use App\Http\Controllers\CustomerCRUDController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/leido', [AdminCodeController::class, 'socketqr']);
Route::get('/getApp',[AdminCodeController::class,'getInformacion']);
Route::post('/mi', [AdminCodeController::class, 'miMetodo'])->name('mi');
Route::post('/codigo_movil', [AdminCodeController::class, 'Validacion_Codigo_Movil']);

Route::resource('/Admin/User', AdminUserController::class)->only([
    'index','create','store'
])->names('Admin/User');