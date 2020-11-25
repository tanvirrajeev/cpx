<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    public function __construct(){
        if (Auth::check() && Auth::user()->role->id == 4){
            $this->redirectTo = route('admin.dashboard');
        }else if (Auth::check() && Auth::user()->role->id == 2){
            $this->redirectTo = route('branch.cpx');
        }else{
            $this->redirectTo = route('customer.cpx');
        }
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $input = $request->all();

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'], 'status' => 'ACTIVE'))){
            // return redirect()->route('home');
            return redirect('/');
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address/Username And Password Are Wrong.');
        }

    }


}
