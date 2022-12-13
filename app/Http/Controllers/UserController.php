<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Cart;
use App\Models\Vehicle;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

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
    public function index(Request $request){
        $pickup = $request->input('pickup');
        $return = $request->input('return');
        // if($pickup == null || $return == null){
        //     return redirect('/#brands')->with('error','Please select date');
        //     //return redirect('/');
        // }else{
        //  Problem
        $data = DB::table('vehicles')
                ->leftJoin('bookings', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
                ->select( 'vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price',DB::raw('COUNT(vehicles.vehicle_id)'))
                ->Where('book_id',null)
                ->orwhereNotBetween('pickup_date',[$pickup,$return])
                ->WhereNotBetween('return_date',[$pickup,$return])
                ->orwhere('pickup_date', '>', $pickup)
                ->Where('return_date', '<', $return)
                ->groupBy('vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                ->get();
        // }
        // DB::table('bookings')->where('return_date','<',Carbon::now())->delete();
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


        $data = DB::table('vehicles')
                ->leftJoin('bookings', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
                ->select( 'bookings.pickup_date', 'bookings.return_date', 'bookings.book_id', 'vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                ->orderBy('book_id', 'DESC')
                ->first();
        return view('users.receipt',['data'=>$data]);


     }
     public function Cart(){
        $user = Auth::user();
        $data = DB::table('vehicles')
                ->leftJoin('carts', 'vehicles.vehicle_id', '=', 'carts.vehicle_id')
                ->select( 'carts.pickup_date', 'carts.return_date', 'vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                ->where('user_id',$user->user_id)
                ->get();
        return view('users.cart',['data'=>$data]);
     }
     public function AddtoCart($vehicle_id,$pickup_date,$return_date){
        $user = Auth::user();
        DB::insert('insert into carts (user_id, vehicle_id, pickup_date, return_date)
                    values (?, ?, ?, ?)',
                    [$user->user_id, $vehicle_id, $pickup_date, $return_date]);

        return redirect('/Cart');
     }
     public function Checkout(){
        $user = Auth::user();
        // $data = DB::table('carts')->where('user_id',$user->user_id)->get();
        $data = DB::table('vehicles')
                ->leftJoin('carts', 'vehicles.vehicle_id', '=', 'carts.vehicle_id')
                ->select( 'carts.pickup_date', 'carts.return_date', 'vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                ->where('user_id',$user->user_id)
                ->get();
        return view('users.cart_confirm',['data'=>$data,'user'=>$user]);
     }
     public function CheckoutStore(Request $request){
        $length = count($request->input('vehicleid'));
        $vehicle = $request->input('vehicleid');
        $pickup = $request->input('pickup');
        $return = $request->input('return');
        $user = Auth::user();
        for ($i=0; $i < $length ; $i++) {
            DB::insert('insert into bookings (user_id, vehicle_id, phone_no, pickup_date, return_date)
                        values (?, ?, ?, ?, ?)',
                        [$user->user_id, $vehicle[$i], $request->input("phoneno"), $pickup[$i], $return[$i]]);

            DB::insert('insert into booking_historys (user_id, vehicle_id, phone_no, pickup_date, return_date)
                        values (?, ?, ?, ?, ?)',
                        [$user->user_id, $vehicle[$i], $request->input("phoneno"), $pickup[$i], $return[$i]]);
        }

        DB::table('carts')->where('user_id',$user->user_id)->delete();
     }

     public function GenerateReceipt($book_id){

        // GENERATE RECEIPT
        $data = DB::table('vehicles')
                ->leftJoin('bookings', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
                ->select( 'bookings.pickup_date', 'bookings.return_date', 'bookings.book_id', 'vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                ->where('book_id',$book_id)
                ->first();

        $templateProcessor = new TemplateProcessor('word-template/receipt.docx');

        $templateProcessor->setImageValue('img', public_path('img/'.$data->img_name));
        $templateProcessor->setValue('brand',$data->brand);
        $templateProcessor->setValue('model',$data->model);
        $templateProcessor->setValue('plate',$data->plate_number);
        $templateProcessor->setValue('pickup',$data->pickup_date);
        $templateProcessor->setValue('return',$data->return_date);


        $fileName = 'Receipt';
        $templateProcessor->saveAs($fileName .'.docx');
        return response()->download($fileName .'.docx')->deleteFileAfterSend(true);
     }
}
