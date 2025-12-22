<?php

namespace App\Http\Controllers;

class SiteController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function services()
    {
        return view('services');
    }

    public function gallery()
    {
        return view('gallery');
    }

    public function contactus()
    {
        return view('contactus');
    }
}