<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }
    public function login(){
        if (Auth::user()) { 
            return redirect('/');
        }else{
            return view('cms/pages/users/login');
            
        }
    }
    public function doLogout(){
    
        Auth::logout(); // logging out user
        return redirect('login'); // redirection to login screen
    }
    public function doLoginCms(Request $request){
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required|min:6'
        ]);
        $userdata = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'role' => 1
        );
        if (Auth::attempt($userdata)){
                return redirect('/');
        }else{
            return redirect('login')->with('error', 'You are not authorized');
        
        }
        
     }
}
