<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/home';

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
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date'],
            'gender' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'street_number' =>'string|required',
            'street_name' => 'string|required',
            'zip_code'=> 'string|required',
            'city'=>'string|required',
            'country'=>'string|required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(array $data)
    {
        //Getting genders for dropdown. To be used when gender table exists
        //$genders = Gender::pluck('name','id');

        $address = Address::firstOrCreate([
            'street_number'=>$data['street_number'],
            'street_name'=>$data['street_name'],
            'zip_code'=>$data['zip_code'],
            'city'=>$data['city'],
            'country'=>$data['country'],
        ]);

        return User::create([
            'name' => $data['name'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'address_id'=>$address->id,

            //'genders' => $genders,

            'password' => Hash::make($data['password']),
        ]);
    }
}
