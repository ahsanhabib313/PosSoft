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
        return view('user.login');
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

        if(Auth::guard('web')->user()->active == 0){
          Auth::logout();
          $request->session()->invalidate();
          $request->session()->regenerateToken();
          return back()->with('fail','You are pending yet...!');
        }

            $request->session()->regenerate();
              return redirect()->route('user.dashboard');
            
           

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

        return redirect()->route('user.login');
       }else{

        $request->session()->flash('error', 'ইউজার সাফল্যের সাথে যুক্ত হয় নি');

        return redirect()->route('user.register');
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
            return redirect('user/login');
     }



 
}
