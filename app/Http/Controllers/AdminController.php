<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user();
        $usersplit = str_split($role->user_id);
        if ($usersplit[0] == 'A') {
            $name = Auth::user();
            $owner = $name->user_id;
            $data = DB::table('vehicles')->where('owner_id',$owner)->get();
            return view('admin.dashboard',['data'=>$data]);
        }
        else{
            echo 'Sorry you dont have permission to this page';
        }

    }

    //UPLOAD VEHICLE
    public function indexUpload(){
        return view('admin.upload');
    }

    public function StoreVehi(Request $request){
        $destinationPath = 'img';
        $myimage = $request->file('img')->getClientOriginalName();
        $request->file('img')->move(public_path($destinationPath), $myimage);

        $name = Auth::user();
        $owner = $name->user_id;
        DB::insert('insert into vehicles (owner_id, img_name, plate_number, model, brand, cc, price)
                    values (?, ?, ?, ?, ?, ?, ?)',
                    [$owner, $myimage, $request->input('plate'), $request->input('model'), $request->input('brand'), $request->input('cc'), $request->input('price')]);
        $vehicle = DB::table('vehicles')->orderBy('vehicle_id','DESC')->first();
        return redirect('/Admin');
    }
    public function DeleteVehi($vehicle_id){
        $vehiInfo = DB::table('vehicles')->where('vehicle_id',$vehicle_id)->first();
        $path = "/img/$vehiInfo->img_name";
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
        DB::table('vehicles')->where('vehicle_id',$vehicle_id)->delete();
        return redirect('/Admin');

    }
    public function EditVehi($vehicle_id){
        $data = DB::table('vehicles')->where('vehicle_id',$vehicle_id)->first();
        return view('admin.edit',['data'=>$data]);
    }
    public function EditVehiConfirm(Request $request, $vehicle_id){
        $plate = $request->input('plate');
        $model = $request->input('model');
        $brand = $request->input('brand');
        $cc = $request->input('cc');
        $price = $request->input('price');

        $updatearr = array(
            'plate_number' => $plate,
            'model' => $model,
            'brand' => $brand,
            'cc' => $cc,
            'price' => $price
        );

        DB::table('vehicles')->where('vehicle_id',$vehicle_id)->update($updatearr);
        return redirect('/Admin');
    }

    public function BookedVehi(){
        $data = DB::table('vehicles')
                    ->leftJoin('bookings', 'vehicles.vehicle_id', '=', 'bookings.vehicle_id')
                    ->select( 'bookings.book_id','bookings.pickup_date', 'bookings.return_date', 'vehicles.vehicle_id', 'vehicles.cc', 'vehicles.img_name', 'vehicles.plate_number', 'vehicles.model', 'vehicles.brand', 'vehicles.price')
                    ->whereNotNull('book_id')
                    ->get();
        return view('admin.booked',['data'=>$data]);
    }
}
