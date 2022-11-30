<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/Profile', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//ADMIN
Route::get('/Admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('/Upload', [App\Http\Controllers\AdminController::class, 'indexUpload']);
Route::post('/Store_info', [App\Http\Controllers\AdminController::class, 'StoreVehi']);
Route::get('/Delete/{vehicle_id}', [App\Http\Controllers\AdminController::class, 'DeleteVehi']);




//User
Route::post('/Book', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/Book/{vehicle_id}/Booking_form', [App\Http\Controllers\UserController::class, 'BookForm']);
Route::get('/Book/{vehicle_id}/Vehicle_detail', [App\Http\Controllers\UserController::class, 'VehicleDetail']);
Route::post('/Store_booking/{vehicle_id}', [App\Http\Controllers\UserController::class, 'StoreBooking']);


Route::get('/test', [App\Http\Controllers\UserController::class, 'test']);
