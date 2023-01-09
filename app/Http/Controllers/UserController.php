<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Cart;
use App\Models\Vehicle;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use Illuminate\Foundation\Exceptions\Whoops\WhoopsExceptionRenderer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LengthException;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use PhpOffice\PhpWord\Element\Table;

class UserController extends Controller
{
    public function index(Request $request){
        $pickup = $request->input('pickup');
        $return = $request->input('return');
        if($pickup == null || $return == null){
            return redirect('/#brands')->with('error','Please Select Date');
            //return redirect('/');
        }elseif ($return < $pickup) {
            return redirect('/#brands')->with('error','Please Re-Check Your Input');
        }
        else{
            $available = DB::table('vehicles')
                        ->leftJoin('bookings', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
                        ->select('vehicles.plate_number')
                        ->whereBetween('bookings.pickup_date',[$pickup,$return])
                        ->orWhereBetween('bookings.return_date',[$pickup,$return])
                        ->get();
            $arr = json_decode(json_encode($available), true);
            $data = DB::table('vehicles')
                     ->leftJoin('bookings', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
                     ->select('vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                     ->whereNotIn('plate_number',$arr)
                     ->distinct()
                     ->get();

        }
        // DB::table('bookings')->where('return_date','<',Carbon::now())->delete();
        //   dump($data);
        return view('users.catalog',['data'=>$data, 'pickup'=>$pickup, 'return'=>$return]);
    }
     public function BookForm($vehicle_id,$pickup,$return){
        $vehicle = Vehicle::all()->where('vehicle_id',$vehicle_id)->first();

        $interval = date_diff(new DateTime($pickup),new DateTime($return));
        $price = explode(" ",$vehicle->price);
        $price = array_map('intval', $price);

        $total = $price[1]*$interval->d;

        $user = Auth::user();
        return view('users.booking_form',['user'=>$user,'vehicle'=>$vehicle,'pickup'=>$pickup,'return'=>$return, 'total'=>$total]);
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
        $price = $request->input('price');

        $name = Auth::user();
        if ($phoneno == null) {
            return redirect("/Book/$vehicle_id/from$pickup"."to$return/Booking_form")->with('error','Please Enter Your Phone Number');
        }

        $booking = DB::table('vehicles')
                ->leftJoin('bookings', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
                ->select( 'bookings.pickup_date', 'bookings.return_date', 'bookings.book_id', 'vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                ->where('user_id',$name->user_id)
                ->where('pickup_date',$pickup)
                ->where('return_date',$return)
                ->get();

        // dump(count($data));
        if (count($booking) == 0) {
            DB::insert('insert into bookings (user_id, vehicle_id, phone_no, pickup_date, return_date)
                    values (?, ?, ?, ?, ?)',
                    [$name->user_id, $vehicle_id, $phoneno, $pickup, $return]);

            DB::insert('insert into booking_historys (user_id, vehicle_id, phone_no, pickup_date, return_date)
                        values (?, ?, ?, ?, ?)',
                        [$name->user_id, $vehicle_id, $phoneno, $pickup, $return]);

            $data = DB::table('vehicles')
                ->leftJoin('bookings', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
                ->select( 'bookings.pickup_date', 'bookings.return_date', 'bookings.book_id', 'vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                ->where('user_id',$name->user_id)
                ->where('pickup_date',$pickup)
                ->where('return_date',$return)
                ->get();
            // return view('users.receipt',['data'=>$data]);
            return redirect( "/payment/{$price}" );

        }
        else{

            $data = DB::table('vehicles')
                ->leftJoin('bookings', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
                ->select( 'bookings.pickup_date', 'bookings.return_date', 'bookings.book_id', 'vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                ->where('user_id',$name->user_id)
                ->where('pickup_date',$pickup)
                ->where('return_date',$return)
                ->get();

            // return view('users.receipt',['data'=>$data]);
            return redirect( "/payment/{$price}" );
        }
     }
     public function CancelConfirm($book_id){
        $vehidata = DB::table('vehicles')
                    ->leftJoin('bookings', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
                    ->select( 'bookings.book_id','bookings.pickup_date', 'bookings.return_date', 'vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                    ->where('book_id',$book_id)
                    ->first();
        return view('users.cancel_booking',['book_id'=>$book_id, 'vehidata'=>$vehidata]);
     }

     public function CancelBooking($book_id){
        DB::table('bookings')->where('book_id',$book_id)->delete();
        return redirect('/Profile');
     }
     public function Cart(){
        $user = Auth::user();
        $data = DB::table('vehicles')
                ->leftJoin('carts', 'vehicles.vehicle_id', '=', 'carts.vehicle_id')
                ->select( 'carts.cart_id', 'carts.pickup_date', 'carts.return_date', 'vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price', 'vehicles.cc')
                ->where('user_id',$user->user_id)
                ->get();

        $length = count($data);

        // Date
        $datearray = array();
        for ($i=0; $i < $length; $i++) {
            $date1 = new DateTime($data[$i]->pickup_date);
            $date2 = new DateTime($data[$i]->return_date);

            $interval = date_diff($date1,$date2);
            array_push($datearray,$interval);
        }

        // Price
        $pricearray = array();
        for ($i=0; $i < $length; $i++) {
            $price = $data[$i]->price;
            $splitted = explode(" ",$price);
            array_push($pricearray,$splitted[1]);
        }

        $pricelength = count($pricearray);
        $pricearray = array_map('intval', $pricearray);
        // $datearray = array_map('intval', $datearray);
        $total = 0;
        for ($i=0; $i < $pricelength; $i++) {
            $actualvalue = $pricearray[$i] * $datearray[$i]->d;
            $total += $actualvalue;
        }
        return view('users.cart',['data'=>$data, 'total'=>$total]);
        // dump($datearray[1]->d);
        // dump($data);
     }

     public function AddtoCart($vehicle_id,$pickup_date,$return_date){
        $user = Auth::user();
        DB::insert('insert into carts (user_id, vehicle_id, pickup_date, return_date)
                    values (?, ?, ?, ?)',
                    [$user->user_id, $vehicle_id, $pickup_date, $return_date]);

        return redirect('/Cart');
     }
     public function Deleteitem($cart_id){
        Cart::where('cart_id',$cart_id)->delete();
        return redirect('/Cart');
     }

     public function Checkout($total){
        $user = Auth::user();
        $data = DB::table('vehicles')
                ->leftJoin('carts', 'vehicles.vehicle_id', '=', 'carts.vehicle_id')
                ->select( 'carts.pickup_date', 'carts.return_date', 'vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                ->where('user_id',$user->user_id)
                ->get();
        return view('users.cart_confirm',['data'=>$data,'user'=>$user, 'total'=>$total]);
     }
     public function CheckoutStore(Request $request){
        $length = count($request->input('vehicleid'));
        $vehicle = $request->input('vehicleid');
        $pickup = $request->input('pickup');
        $return = $request->input('return');
        $total = $request->input('total');
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

        $data = DB::table('vehicles')
                ->leftJoin('bookings', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
                ->select( 'bookings.pickup_date', 'bookings.return_date', 'bookings.book_id', 'vehicles.vehicle_id', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                ->where('user_id',$user->user_id)
                ->where('pickup_date',$pickup)
                ->where('return_date',$return)
                ->get();
        // return view('users.receipt',['data'=>$data]);
        return redirect( "/payment/{$total}");
     }


    public function ContactUs(){
        return view('users.contact_us');
    }
      public function GenerateReceipt(Request $request){
        $templateProcessor = new TemplateProcessor('word-template/receipt.docx');


        $img = $request->input('img');
        $brand = $request->input('brand');
        $model = $request->input('model');
        $pickup = $request->input('pickup');
        $return = $request->input('return');
        $length = count($img);
        $templateProcessor->cloneBlock('info',$length, true, true);

        for ($i=1; $i <= $length; $i++) {
            $templateProcessor->setImageValue("img#$i", public_path('img/'.$img[$i-1]));
            $templateProcessor->setValue("brand#$i", $brand[$i-1]);
            $templateProcessor->setValue("model#$i", $model[$i-1]);
        }



         $fileName = 'Receipt';
         $templateProcessor->saveAs($fileName .'.docx');
         return response()->download($fileName .'.docx')->deleteFileAfterSend(true);
      }
}
