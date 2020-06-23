<?php


namespace App\Http\Controllers\Frontend;
use App\Models\BlogModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function login()
    {
        return view('frontend.pages.user.login',['page' => 'user']);
    }
    public function register()
    {
        return view('frontend.pages.user.register',['page' => 'user']);
    }
    public function forgotpassword()
    {
        return view('frontend.pages.user.forgotpassword',['page' => 'user']);
    }
    public function resetpassword()
    {
        return view('frontend.pages.user.resetpassword',['page' => 'user']);
    }
}