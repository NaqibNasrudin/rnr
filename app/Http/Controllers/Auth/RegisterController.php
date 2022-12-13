<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    // protected function redirectTo()
    // {
    //     if (auth()->user()->name == 'Admin') {
    //         return '/Dashboard';
    //     }
    //     return '/';
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // $profile = User::where('name', $data['name'])->where('email',$data['email'])->first();
        if ($data['name'] == 'Admin') {
            $count = DB::table('users')->where('name','Admin')->count();
            if ($count > 0) {
                // echo 'Wrong Input';
                return view('welcome');
            }else{
                $userid = 'A-'.User::all()->count() + 1;
                $rowid = User::all()->count() + 1;
            }

        }else{
            $userid = 'U-'.User::all()->count() + 1;
            $rowid = User::all()->count() + 1;
        }

        $createUser = User::create([
            'id' => $rowid,
            'user_id' => $userid,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $createUser;
    }
}
