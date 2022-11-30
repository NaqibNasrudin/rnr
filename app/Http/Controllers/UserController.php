<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function test(){
        $date = Booking::all()->first();
        $period = CarbonPeriod::create($date->pickup_date, $date->return_date);
        $dates = $period->toArray();

        $initialDate = new Carbon('2022-12-9');
        $finalDate = new Carbon('2022-12-10');

        $range2 = CarbonPeriod::create($initialDate, $finalDate);
        $dates2 = $range2->toArray();

        $intersect = array_intersect($dates,$dates2);
        foreach ($intersect as $i) {
            echo $i.'<br>';
        }

        $number = count($intersect);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    ////NO IDEA WHATS GOING ON
    public function index(Request $request){
        $pickup = $request->input('pickup');
        $return = $request->input('return');
        $inputrange = CarbonPeriod::create($pickup, $return);
        $dates = $inputrange->toArray();

        $data = DB::table('vehicles')
                ->leftJoin('bookings', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
                ->select('bookings.pickup_date', 'bookings.return_date', 'vehicles.vehicle_id', 'vehicles.owner_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.cc', 'vehicles.price')
                ->get();

        // dump($data[0]->pickup_date);
        $dateArr = array();
        $length = count($data);
        for ($i=0; $i < $length ; $i++) {
            if ($data[$i]->pickup_date == null || $data[$i]->return_date == null) {
                $dateArr[$i] = 'none';
            }
            else{
                $dates = CarbonPeriod::create($data[$i]->pickup_date, $data[$i]->return_date);
                $range = $dates->toArray();
                $dateArr[$i] = $range;
            }
        }
        $dateArr[0][0] = (array)$dateArr[0][0];
        echo gettype($dateArr[0][0]);
        for ($i=0; $i < $length; $i++) {
            for ($j=$i; $j < $i+1; $j++) {
                $dates = (array)$dates;
                $dateArr[$i][$j] = (array)$dateArr[$i][$j];
                $intersect = array_intersect($dateArr[$i][$j],$dates);
            }
        }
        // return view('users.catalog',['data'=>$data]);
    }
     public function BookForm($vehicle_id){
        $vehicle = Vehicle::all()->where('vehicle_id',$vehicle_id)->first();
        $user = Auth::user();
        return view('users.booking_form',['user'=>$user,'vehicle'=>$vehicle]);
     }

     public function VehicleDetail($vehicle_id){
        $vehicle = Vehicle::all()->where('vehicle_id',$vehicle_id)->first();
        return view('users.vehi_detail',['vehicle'=>$vehicle]);
     }
     public function StoreBooking(Request $request, $vehicle_id){
        // $name = $request->input('name');
        // $email = $request->input('email');
        $phoneno = $request->input('phoneno');
        $pickup = $request->input('pickup');
        $return = $request->input('return');

        $name = Auth::user();

        DB::insert('insert into bookings (user_id, vehicle_id, phone_no, pickup_date, return_date)
                    values (?, ?, ?, ?, ?)',
                    [$name->user_id, $vehicle_id, $phoneno, $pickup, $return]);

        DB::insert('insert into booking_historys (user_id, vehicle_id, phone_no, pickup_date, return_date)
                    values (?, ?, ?, ?, ?)',
                    [$name->user_id, $vehicle_id, $phoneno, $pickup, $return]);
        print('Booking Successfull');
     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
