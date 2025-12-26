<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

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

    public function sendContactEmail(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Send email
        Mail::to('reveliowalker22@gmail.com')->send(new ContactFormMail($request->all()));

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}