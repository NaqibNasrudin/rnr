<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;

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
        $data = DB::table('vehicles')
                ->leftJoin('bookings', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
                ->select( 'vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price',DB::raw('COUNT(vehicles.vehicle_id)'))
                ->whereNotBetween('pickup_date',[$pickup,$return])
                ->WhereNotBetween('return_date',[$pickup,$return])
                ->orwhere('pickup_date', '>', $pickup)
                ->Where('return_date', '<', $return)
                ->orWhere('pickup_date',null)
                ->Where('return_date',null)
                ->groupBy('vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                ->get();
        return view('users.catalog',['data'=>$data, 'pickup'=>$pickup, 'return'=>$return]);
    }
     public function BookForm($vehicle_id,$pickup,$return){
        $vehicle = Vehicle::all()->where('vehicle_id',$vehicle_id)->first();
        $user = Auth::user();
        return view('users.booking_form',['user'=>$user,'vehicle'=>$vehicle,'pickup'=>$pickup,'return'=>$return]);
     }
     //VEHICLE DETAIL
     public function VehicleDetail($vehicle_id,$pickup,$return){
        $vehicle = Vehicle::all()->where('vehicle_id',$vehicle_id)->first();
        return view('users.vehi_detail',['vehicle'=>$vehicle,'pickup'=>$pickup,'return'=>$return]);
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

        function generatedoc(){
            $templateProcessor = new TemplateProcessor('word-template/receipt.docx');


            $fileName = 'Receipt';
            $templateProcessor->saveAs($fileName .'.docx');
            return response()->download($fileName .'.docx')->deleteFileAfterSend(true);
        }
        generatedoc();
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
