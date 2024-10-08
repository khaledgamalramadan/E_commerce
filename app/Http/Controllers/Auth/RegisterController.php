<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
            'fristName'     => ['required', 'string', 'max:255'],
            'lastName'      => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'phone'         => ['required', 'string', 'max:14'],
            'city'          => ['required', 'string', 'max:255'],
            'country'       => ['required', 'string', 'max:255'],
            'pincode'       => ['required', 'max:255'],
            'address1'      => ['required', 'string', 'max:255']
        ]);
    }

    /**
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'fristName' => $data['fristName'],
            'lastName'  => $data['lastName'],
            'email'     => $data['email'],
            'phone'     => $data['phone'],
            'city'      => $data['city'],
            'country'   => $data['country'],
            'pincode'   => $data['pincode'],
            'address1'  => $data['address1'],
            'password'  => Hash::make($data['password']),

        ]);
    }
}
