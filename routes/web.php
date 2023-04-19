<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminCodeController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminProductsController;
use App\Http\Controllers\AdminRolesController;
use App\Http\Controllers\CustomerProductsController;
use App\Http\Controllers\SupervisorCodeController;
use App\Http\Controllers\SupervisorTokenController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Administador autenticacion
Route::group(['middleware' => 'signed','role:Admin'], function() {
    Route::get('/code_Admin', [AdminCodeController::class, 'show'])->name("vista_codigo_Admin");
    Route::get('/qrcode', [AdminCodeController::class,'qr_qenerate']);
    Route::resource('/Envio_Codigo_Admin',AdminCodeController::class)->only([
        'index'
    ])->names('enviar_admin')->except(['show'])->withoutMiddleware(['signed']);
    Route::post('/Envio_Codigo_Admin/dashboard', [AdminCodeController::class, 'Validar_codigo_login'])->withoutMiddleware(['signed'])->name('Bienvenido_Admin');
});
//

//Supervisor autenticacion
Route::group(['middleware' => 'signed','role:Supervisor'], function() {
    Route::get('/code_supervisor', [SupervisorCodeController::class, 'show'])->name("vista_codigo_Supervisor");
    Route::resource('/Envio_Codigo_Supervisor',SupervisorCodeController::class)->only([
        'index'
    ])->names('enviar_supervisor')->except(['show'])->withoutMiddleware(['signed']);
    Route::post('/Envio_Codigo_Supervisor/dashboard', [SupervisorCodeController::class, 'Validar_codigo_login'])->withoutMiddleware(['signed'])->name('Bienvenido_Supervisor');
});

Route::group(['middleware' => ['auth']], function (){
    //Roles Administrador y Supervisor con permisos
    //Envio correo para peticion token cliente a supervisor
    Route::get('/productos/Pedir_Permisos_Cliente', [CustomerProductsController::class, 'Pedir_Permisos_Cliente'])->name('productos.Pedir_Permisos_Cliente');
    //Envio correo para peticion token supervisor a admin
    Route::get('/Dashboard/SupervisorToken/Pedir_Permisos_Supervisor', [SupervisorTokenController::class, 'Pedir_Permisos_Supervisor'])->name('Dashboard.SupervisorToken.Pedir_Permisos_Supervisor');
    //Token Permiso Supervisor
    Route::get('/code_Token_Supervisor', [AdminUserController::class, 'show'])->name("Vista_Token_Supervisor");
    //Datos CRUD User
    Route::resource('/Dashboard/User', AdminUserController::class)->names('Dashboard/User');
    //Validar Token permiso para desactivar a usuario
    Route::put('/Dashboard/User/SupervisorToken/TokenPermiso', [AdminUserController::class, 'Verificar_Token_Supervisor'])->name('Dashboard.User.SupervisorToken.TokenPermiso');
    //Status
    Route::put('/Dashboard/User/status/{id}', [AdminUserController::class, 'status'])->name('Dashboard.User.status');
    //Datos CRUD Products
    Route::resource('/Dashboard/Products', AdminProductsController::class)->names('Dashboard/Products');
    //Status
    Route::put('/Dashboard/Products/status/{id}', [AdminProductsController::class, 'status'])->name('Dashboard.Products.status');
    //Datos CRUD Roles
    Route::resource('/Dashboard/Roles', AdminRolesController::class)->names('Dashboard/Roles');
    //Datos CRUD Customer Products
    Route::resource('/productos', CustomerProductsController::class)->names('productos');
    //Status
    Route::put('/productos/status/{id}', [CustomerProductsController::class, 'status'])->name('productos.status');
    //Validar Token permiso editar a cliente
    Route::put('/productos/CustomerToken/TokenPermiso', [CustomerProductsController::class, 'Verificar_Token_Customer'])->name('productos.CustomerToken.TokenPermiso');
    //Supervisor Token de supervisor a Cliente
    Route::resource('/Dashboard/SupervisorToken', SupervisorTokenController::class)->names('Dashboard/SupervisorToken');
    //Enviar Token supervisor a cliente
    Route::put('/Dashboard/SupervisorToken/Token_customer/{id}', [SupervisorTokenController::class, 'Enviar_Correo_Token_cliente'])->name('Dashboard.SupervisorToken.Token_customer');
    //Enviar Token admin a supervisor
    Route::put('/Dashboard/SupervisorToken/Token_supervisor/{id}', [SupervisorTokenController::class, 'Enviar_Correo_Token_supervisor'])->name('Dashboard.SupervisorToken.Token_supervisor');
    //Token Permiso Customer
    Route::get('/code_Token_Customer', [SupervisorTokenController::class, 'show'])->name("Vista_Token_Customer");
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'MiddlewareCode'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
