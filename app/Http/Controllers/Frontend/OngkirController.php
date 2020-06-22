<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
class OngkirController extends Controller
{
    public function index()
    {
        return view('frontend.pages.ongkir.index');
    }
}