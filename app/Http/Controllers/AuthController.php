<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginIndex()
    {
        return view('auth.login');
    }

    /**
     * 
     * login user method
     * 
     */
    public function login(Request $request){

        //validate the input 
       $request->validate([

        'email'    => 'required',
        'password' => 'required'

      ]);

      $email = $request->email;
      $password = $request->password;
      $remember = $request->rememberMe;
    


      if(Auth::attempt(['email' => $email, 'password' => $password], $remember)){

            $request->session()->regenerate();
            if(Auth::check()){
              return redirect()->route('home');
            }
           

      }else{
        
      $request->session()->flash('error','আপনার দেওয়া তথ্যে ভুল আছে ');
      return back();

      }


    }

    /**
     * 
     * registration page show
     * 
     */
    public function registerIndex(){
        return view('auth.register');
    }

    /**
     * 
     * registration the user
     * 
     */

     public function register(Request $request){

       //validate the input 
       $request->validate([

                'username' => 'required|unique:users',
                'email'    => 'required|unique:users',
                'password' => 'required'
       ]);

       $user = User::create([

           'username' => $request->username,
           'email'    => $request->email,
           'password' => Hash::make( $request->password)

       ]);

       if($user){

        $request->session()->flash('success', 'ইউজার সাফল্যের সাথে যুক্ত হয়েছে');

        return redirect()->route('login');
       }else{

        $request->session()->flash('error', 'ইউজার সাফল্যের সাথে যুক্ত হয় নি');

        return redirect()->route('employee.registration');
       }

      

     }

     
    /**
     * 
     * logout 
     * 
     * 
     */

     public function logout(Request $request){

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login');
     }



 
}
