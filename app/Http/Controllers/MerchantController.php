<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merchants = Merchant::all();

        $totalAlert = DB::table('notifications')->where('read_at', null)->count(); 

        return view('admin.merchant', compact('merchants','totalAlert'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      
         //validate the resource
         $request->validate([

            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            
        ],[
           'name.required' => 'আড়ৎদারের নাম পূরণ করা হয় নি ',
           'phone.required' => 'মোবাইল নাম্বার পূরণ করা হয় নি ',
           'address.required' => 'ঠিকানা পূরণ করা হয় নি ',
        ]);     

   
  
   //store the resource in database table
   $store = Merchant::create([

            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,

   ]);

   if($store){

       $request->session()->flash('success', 'আড়ৎদার সফলতার সাথে যোগ করা হয়েছে..');
       return back();
   }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function show(Merchant $merchant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function edit(Merchant $merchant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
            //validate the resource
            $request->validate([

                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',

            ],[
                'name.required' => 'আড়ৎদারের নাম পূরণ করা হয় নি ',
                'phone.required' => 'মোবাইল নাম্বার পূরণ করা হয় নি ',
                'address.required' => 'ঠিকানা পূরণ করা হয় নি ',
            ]); 
            //get the employee instance
            $merchant = Merchant::find($request->merchant_id);
            $merchant->name = $request->name;
            $merchant->phone = $request->phone;
            $merchant->address = $request->address;

            //store the resource in database table
            $store = $merchant->save();

            if($store){

            $request->session()->flash('success', 'আড়ৎদার সফলতার সাথে হালনাগাদ করা হয়েছে...');
            return back();
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $merchant_id = $request->merchant_id;
        
        //get the merchant profile
        $merchant = Merchant::find($merchant_id);

        //delete the merchant profile
        $delete = $merchant->delete();

        if($delete){
            return back()->with('success',' আড়ৎদার সফলতার সাথে বাতিল করা হয়েছে...');
        }
    }
}
