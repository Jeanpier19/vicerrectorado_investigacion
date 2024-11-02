<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Descripcion;
use App\TipoPublicacion;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {
        // header
        $descripcion = Descripcion::latest('updated_at')
            ->first();
        $tipos_publicacion = TipoPublicacion::where('active', 1)
            ->orderBy('main', 'desc')
            ->orderBy('nombre')
            ->get();
        //
        return view('auth.login', compact('descripcion', 'tipos_publicacion'));
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $userLoggedIn = auth()->user();
            if($userLoggedIn->status == 0) {
                $this->guard()->logout();
                $request->session()->invalidate();
                return $this->loggedOut($request) ?: redirect('/login')->with('errorMessage', 'Usted se encuentra inhabilitado(a). Contacte con el administrador para mayor información.');
            }elseif ($userLoggedIn->status == 1) {
                return $this->sendLoginResponse($request);
            }elseif ($userLoggedIn->status == 2) {
                $this->guard()->logout();
                $request->session()->invalidate();
                return $this->loggedOut($request) ?: redirect('/login')->with('errorMessage', 'Su solicitud de creación de cuenta aún no ha sido procesada. Contacte con el administrador para mayor información.');
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}