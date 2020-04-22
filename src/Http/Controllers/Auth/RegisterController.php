<?php

namespace Photogabble\Portcullis\Http\Controllers\Auth;

use Photogabble\Portcullis\Http\Controllers\Controller;
use Photogabble\Portcullis\Entities\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Photogabble\Portcullis\Http\Middleware\CheckRegistrationAllowed;

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
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = config('registration.home');
        $this->middleware('guest');
        $this->middleware(CheckRegistrationAllowed::class);
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
            'display_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Photogabble\Portcullis\Entities\User
     */
    protected function create(array $data)
    {
        return User::create([
            'display_name' => $data['display_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
