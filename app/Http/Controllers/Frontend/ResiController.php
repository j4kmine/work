<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
class ResiController extends Controller
{
    public function index()
    {
        return view('frontend.pages.resi.index');
    }
}