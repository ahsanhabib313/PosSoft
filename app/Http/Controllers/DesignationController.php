<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          //get unread notification 
          $totalAlert = DB::table('notifications')->where('read_at', null)->count(); 
        $designations = Designation::all();
        return view('admin.designation', compact('designations', 'totalAlert'));
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
        ],[
            'name.required' => 'পদবি ইনপুট ফিল্ড পূরণ করা হয় নি ',
        ]);

        //store the resource
        $store = Designation::create([
            
             'name' => $request->name,
        ]);

        if($store){
            $request->session()->flash('success', 'পদবি সাফল্যের সাথে যোগ করা হয়েছে...');
            return back();
        }
    }

    
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //validate the resource
        $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'পদবি ইনপুট ফিল্ড পূরণ করা হয় নি ',
        ]);

        //store the resource
        $update = Designation::where('id', $request->id)
                         ->update([
            
                                 'name' => $request->name,
                                 ]);

        if($update){
            $request->session()->flash('success', 'পদবি সাফল্যের সাথে আপডেট হয়েছে...');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //get the specific designation
        $designation = Designation::where('id', $request->id)->first();  

        try{
                
                 $designation->delete();
               
        }catch(Exception  $e){

            $request->session()->flash('delete', $e->getMessage());
            return back();
        }

        $request->session()->flash('delete', 'পদবি সাফল্যের সাথে মুছে  ফেলা হয়েছে...');
        return back();
        
    }
    
}
