<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //index function 
    public function index(){

        return view('admin.dashboard');
    }
    
}
