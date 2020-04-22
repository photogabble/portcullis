<?php

namespace Photogabble\Portcullis\Http\Controllers\Auth;

use Photogabble\Portcullis\Http\Controllers\Controller;
use Photogabble\Portcullis\Entities\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use WhichBrowser\Parser;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'), ['disabled_on' => null]);
    }

    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param mixed $user
     * @return void
     */
    protected function authenticated(Request $request, User $user)
    {
        $userAgent = $request->header('User-Agent');
        $browser = new Parser($userAgent);

        activity()
            ->causedBy($user)
            ->withProperties(['user-agent' => $userAgent])
            ->log("Logged in from the {$browser->browser->name} browser on {$browser->os->toString()}");
    }
}
