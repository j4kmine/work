<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\UserModel;
use Illuminate\Http\Request;
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register(){
        return view('cms/pages/users/register');
    }
    public function doRegisterCms(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'lastname'=>'required',
            'email'=>'required|email',
            'tos'=>'required',
            'address'=>'required',
            'datebirth'=>'required',
            'membershiptype'=>'required',
            'membershifee'=>'required',
            'ccnumber'=>'required',
            'cctype'=>'required',
            'gender'=>'required',
            'ccexpiremonth'=>'required',
            'ccexpireyear'=>'required',
            'password'=>'required|min:6|confirmed'
        ]);
    
      
        $contact = new UserModel([
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'password' => bcrypt($request->get('password')),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'membershiptype' => $request->get('membershiptype'),
            'membershifee' => $request->get('membershifee'),
            'ccnumber' => $request->get('ccnumber'),
            'datebirth' => date('Y-m-d H:i:s', strtotime($request->get('datebirth'))),
            'cctype' => $request->get('cctype'),
            'gender' => $request->get('gender'),
            'ccexpiremonth' => $request->get('ccexpiremonth'),
            'ccexpireyear' => $request->get('ccexpireyear')
        ]);
        $data = $contact->save();
        return redirect('/login')->with('success', 'Success Input Data');
    }
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
