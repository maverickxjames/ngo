<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public static function about(){
        return view('aboutus');
    }

    public static function contact(){
        return view('contactus');
    }
}
