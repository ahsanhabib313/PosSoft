<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\CustomNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function login(Request $request){

        //validate the input 
       $request->validate([

        'email'    => 'required',
        'password' => 'required'

      ]);

      //set the input in variables
      $email = $request->email;
      $password = $request->password;
      $remember = $request->rememberMe;
    
      if(Auth::guard('admin')->attempt(['email' => $email, 'password' => $password], $remember)){
          
            if(Auth::guard('admin')->user()->active == 0){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('admin.login')->with('fail','You are pending yet...!');
            }else{
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
                
            }  

      }else{
        
            $request->session()->flash('fail','Your  information is Wrong...');
            return back();

      }


    }


    //registration method
    public function register(Request $request){

        //validate the input 
        $request->validate([
 
                 'username' => 'required|unique:users',
                 'email'    => 'required|unique:users',
                 'password' => 'required'
        ]);
 
        $user = Admin::create([
 
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make( $request->password)
 
        ]);
 
        if($user){
 
         $request->session()->flash('success', 'Admin has been  registered successfully....');
 
         return redirect()->route('admin.login');
        }else{
 
         $request->session()->flash('fail', 'Admin has been registered fail....');
 
         return redirect()->route('admin.register');
        }
 
       
 
      }
    //index function 
    public function index(Request $request ){

        $todaysDate = date('Y-m-d', time());

        $monthlyDate = date('Y-m-d', time()-30*24*60*60);
        $yearlyDate = date('Y-m-d', time()-365*24*60*60);
        
        $dailyOrders =DB::table('orders')->whereDate('created_at', $todaysDate)->count();
        $dailySells =DB::table('orders')->whereDate('created_at',  $todaysDate)->sum('totalPrice');

        $monthlyOrders =DB::table('orders')->whereBetween('created_at',[$monthlyDate, $todaysDate])->count();
        $monthlySells =DB::table('orders')->whereBetween('created_at',[$monthlyDate, $todaysDate])->sum('totalPrice');


        $yearlyOrders =DB::table('orders')->whereBetween('created_at',[$yearlyDate, $todaysDate])->count();
        $yearlySells =DB::table('orders')->whereBetween('created_at',[$yearlyDate, $todaysDate])->sum('totalPrice');
       
         //create notifications
         $totalAlert  = DB::table('notifications')->where('read_at', NULL)->count(); 
        
        return view('admin.dashboard', compact('dailyOrders','dailySells','monthlyOrders','monthlySells','yearlySells','yearlyOrders', 'totalAlert'));
    }




    //get the dashboard notication
     public function showNotification(Request $request){

              //get the expired product
          $todaysDate = date('Y-m-d', time()+6*3600);
          $expiredProducts = Product::whereDate('expireDate', '<',  $todaysDate)->get();
          
          if(!is_null($expiredProducts)){
  
              foreach($expiredProducts as $expiredProduct){
                  $data =[
                      'info' => $expiredProduct->productName.' '.$expiredProduct->productWeight.' '.$expiredProduct->productWeightUnit.' মেয়াদোত্তীর্ণ হয়ে গেছে...!!!'
                  ];
      
                  Auth::guard('admin')->user()->notify(new CustomNotification($data));
              } 
  
          }
  
          //get the lowest product
          $lowQuantiyProducts = Product::where('quantity', '<=', 'alertQuantity')->get();
  
          if(!is_null($lowQuantiyProducts)){
              foreach($lowQuantiyProducts as $lowQuantiyProduct){
                  $data =[
                      'info' => $lowQuantiyProduct->productName.' '.$lowQuantiyProduct->productWeight.' '.$lowQuantiyProduct->productWeightUnit.' ন্যূনতম পরিমানের নিচে নেমে গেছে...!!!'
                  ];
      
                  Auth::guard('admin')->user()->notify(new CustomNotification($data));
              }
          }
             $totalAlert  = DB::table('notifications')->where('read_at', null)->count(); 

             $productNotification = '';
            
             foreach(Auth::guard('admin')->user()->unreadNotifications as $notification) {
                
                $productNotification .= '<li>
                <a href="#">
                    <i class="icon icon-data_usage text-success"></i>'.$notification->data['data'].'
                </a>
               </li>';
                
             }


            return response()->json([

                'status' => 'success',
                'totalAlert' => $totalAlert,
                'productNotification' => $productNotification

            ]);


        
    } 
    

    public function markAsReadNotification(){

       

     

        //delete read message 
        Auth::guard('admin')->user()->notifications()->delete();
        //delete read message 
        Auth::guard('web')->user()->notifications()->delete();

        return response()->json([
            'status' => 'success'
        ]);
        
       

    }

    public function logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('admin/login');
 }
    
}
