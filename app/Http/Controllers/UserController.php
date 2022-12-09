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


        $data = DB::table('vehicles')
                ->leftJoin('bookings', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
                ->select( 'bookings.pickup_date', 'bookings.return_date', 'bookings.book_id', 'vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                ->orderBy('book_id', 'DESC')
                ->first();
        return view('users.receipt',['data'=>$data]);


     }

     public function GenerateReceipt($book_id){

        // GENERATE RECEIPT
        $data = DB::table('vehicles')
                ->leftJoin('bookings', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
                ->select( 'bookings.pickup_date', 'bookings.return_date', 'bookings.book_id', 'vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                ->where('book_id',$book_id)
                ->first();

        $templateProcessor = new TemplateProcessor('word-template/receipt.docx');

        $templateProcessor->setValue('plate',$data->plate_number);
        $templateProcessor->setValue('pickup',$data->pickup_date);
        $templateProcessor->setValue('return',$data->return_date);


        $fileName = 'Receipt';
        $templateProcessor->saveAs($fileName .'.docx');

        // $phpWord = IOFactory::load($fileName .'.docx');
        // $phpWord->save('document.pdf', 'PDF');
        return response()->download($fileName .'.docx')->deleteFileAfterSend(true);
     }
}
