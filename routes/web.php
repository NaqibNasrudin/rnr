<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
    $now = Carbon::now();
    DB::table('bookings')->where('return_date','<',$now)->delete();

    $date = Carbon::now()->toDateString();
    return view('welcome',['date'=>$date]);
});

Auth::routes();

Route::get('/Profile', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//ADMIN
Route::get('/Admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('/Upload', [App\Http\Controllers\AdminController::class, 'indexUpload']);
Route::post('/Store_info', [App\Http\Controllers\AdminController::class, 'StoreVehi']);
Route::get('/Delete/{vehicle_id}', [App\Http\Controllers\AdminController::class, 'DeleteVehi']);
Route::get('/Edit/{vehicle_id}', [App\Http\Controllers\AdminController::class, 'EditVehi']);
Route::post('/Edit_confirm/{vehicle_id}', [App\Http\Controllers\AdminController::class, 'EditVehiConfirm']);

Route::get('/Booked', [App\Http\Controllers\AdminController::class, 'BookedVehi']);




//User
Route::post('/Book', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/Book/{vehicle_id}/from{pickup}to{return}/Booking_form', [App\Http\Controllers\UserController::class, 'BookForm'])->middleware(Authenticate::class);
Route::get('/Book/{vehicle_id}/from{pickup}to{return}/Vehicle_detail', [App\Http\Controllers\UserController::class, 'VehicleDetail']);
Route::post('/Store_booking/{vehicle_id}', [App\Http\Controllers\UserController::class, 'StoreBooking']);
Route::get('/Cart/{vehicle_id}/from{pickup}to{return}', [App\Http\Controllers\UserController::class, 'AddtoCart'])->middleware(Authenticate::class);
Route::get('/Cart', [App\Http\Controllers\UserController::class, 'Cart']);
Route::get('/Checkout/{total}', [App\Http\Controllers\UserController::class, 'Checkout']);
Route::post('/CheckoutStore', [App\Http\Controllers\UserController::class, 'CheckoutStore']);
Route::get('/Delete_Item/{cart_id}', [App\Http\Controllers\UserController::class, 'DeleteItem']);
Route::get('/Cancel_booking/{book_id}', [App\Http\Controllers\UserController::class, 'CancelConfirm']);
Route::get('/Confirm/{book_id}', [App\Http\Controllers\UserController::class, 'CancelBooking']);

Route::get('/Contact_Us', [App\Http\Controllers\UserController::class, 'ContactUs']);


//Payment
Route::get('/payment/{price}', [App\Http\Controllers\ToyyibpayController::class, 'createbill']);

//Receipt
Route::get('/Receipt', [App\Http\Controllers\UserController::class, 'GenerateReceipt'])->name('receipt');


Route::get('/test', [App\Http\Controllers\UserController::class, 'test']);
