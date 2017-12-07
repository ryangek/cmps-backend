<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use App\User;
use Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function login(Request $req){

        if(!Auth::attempt(['email' => $req->email, 'password' => $req->password])){

            return response()->json(['error' => 'Your credential is wrong'], 401);

        }
        $admin = User::where([
            ['email', '=', $req->email],
            ['status', '=', 'administrator']
        ])->get(); // 'email',$req->email

        if($admin->all() === []){

            return response()->json(['error' => 'Your credential is wrong'], 401);

        }

        return response()->json($admin, 200);

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function loginUser(Request $req){

        if(!Auth::attempt(['email' => $req->email, 'password' => $req->password])){

            return response()->json(['error' => 'Your credential is wrong'], 401);

        }

        $user = User::where('email',$req->email)->get();

        return response()->json($user, 200);

    }*/
}
