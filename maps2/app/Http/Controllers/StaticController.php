<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{
    
    public function showRegister()
    {
       
        return view('Auth.register');
    }
    
    
    public function showLogin()
    {
       
        return view('Auth.login');
    }

    public function showContact()
    {
       
        return view('contact');
    }

    public function showGalery()
    {
       
        return view('galery');
    }

    
    public function showWelcome()
    {
       
        return view('Welcome');
    }
    
}
