<?php

namespace App\Http\Controllers;

use App\Models\cr;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * 
     * registration page show
     * 
     */
    public function register(){
        return view('auth.register');
    }

 
}
