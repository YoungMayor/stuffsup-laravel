<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Profile;
use App\Providers\RouteServiceProvider;
use App\Providers\StateMapServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $state_map = StateMapServiceProvider::$___state_map;

        return Validator::make($data, [
            'first_name' => [
                'required',
                'string',
                'min:3',
                'max:64',
                'alpha'
            ],
            'last_name' => [
                'required',
                'string',
                'min:3',
                'max:64',
                'alpha'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'state' => [
                'required',
                Rule::in(array_keys($state_map))
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
        ], [
            'first_name.*' => "First name is Invalid",
            'last_name' => "Last name is invalid",

            'email.required' => "A valid email address is required during registration",
            'email.unique' => "Email address already registered",
            'email.*' => "Email invalid",

            'state.*' => "Select your state of residence",

            'password.min' => "Password too short",
            'password.confirmed' => "Please crosscheck password entries, they do not match"
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $username = "user_" . uniqid();

        return User::create([
            'name' => $username,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $user->profile()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'state' => $request->state
        ]);
    }
}
