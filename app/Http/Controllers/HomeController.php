<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Booking_history;
use Illuminate\Http\Request;
// use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $name = Auth::user();
        $idsplit = str_split($name->user_id);
        $history = DB::table('vehicles')
                    ->leftJoin('booking_historys', 'vehicles.vehicle_id', '=', 'booking_historys.vehicle_id')
                    ->select( 'booking_historys.pickup_date', 'booking_historys.return_date', 'vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                    ->where('user_id',$name->user_id)
                    ->orderBy('Booking_historys.book_id','DESC')
                    ->get();

        $ongoing = DB::table('vehicles')
                    ->leftJoin('bookings', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
                    ->select( 'bookings.book_id','bookings.pickup_date', 'bookings.return_date', 'vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                    ->where('user_id',$name->user_id)
                    ->orderBy('Bookings.book_id','DESC')
                    ->get();
        return view('home',['idsplit'=>$idsplit,'name'=>$name,'history'=>$history, 'ongoing'=>$ongoing]);
    }
}
