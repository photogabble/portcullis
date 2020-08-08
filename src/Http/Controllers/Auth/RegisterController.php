<?php

namespace Photogabble\Portcullis\Http\Controllers\Auth;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Photogabble\Portcullis\Http\Controllers\Controller;
use Photogabble\Portcullis\Entities\User;
use Illuminate\Foundation\Auth\RegistersUsers;
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
        $this->middleware('guest')->except(['passwordConfirm']);
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
        return Validator::make($data, config('registration.validation', []));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \Photogabble\Portcullis\Entities\User
     * @throws Exception
     */
    protected function create(array $data)
    {
        /** @var Closure $mapper */
        $mapper = config('registration.attributes', function(array $data){ return [];});

        if (! $mapper instanceof Closure) {
            throw new Exception('Config key [registration.attributes] must be an instance of Closure.');
        }

        return User::create($mapper($data));
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function passwordConfirm(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $this->validate($request, [
            'password' => [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (! Hash::check($value, $user->password)){
                        $fail($attribute . 'does not match the password set');
                    }
                }
            ]
        ]);
        return redirect($this->redirectTo);
    }

    /**
     * If created accounts have no email associated with them then we need to double check
     * their password (as as password confirmation).
     */
    public function redirectTo(): string
    {
        /** @var User $user */
        $user = Auth::user();

        return is_null($user->email) ? route('register.password-confirm') : $this->redirectTo;
    }
}
