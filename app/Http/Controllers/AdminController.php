<?php

namespace App\Http\Controllers;

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
        // print($myimage);
        // $request->image->move(public_path($destinationPath), $myimage);
        $request->file('img')->move(public_path($destinationPath), $myimage);

        $name = Auth::user();
        $owner = $name->user_id;
        DB::insert('insert into vehicles (owner_id, img_name, plate_number, model, brand, cc, price)
                    values (?, ?, ?, ?, ?, ?, ?)',
                    [$owner, $myimage, $request->input('plate'), $request->input('model'), $request->input('brand'), $request->input('cc'), $request->input('price')]);


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
    public function destroy($id)
    {
        //
    }
}
