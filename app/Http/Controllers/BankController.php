<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{
    public function index()
    {
         $banks = Bank::all();
          //get unread notification 
          $totalAlert = DB::table('notifications')->where('read_at', null)->count(); 
        return view('admin.bank', compact('banks','totalAlert'));
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
            'branch' => 'required',
        ]);

        //store the resource
        $store = Bank::create([
            
             'name' => $request->name,
             'branch' => $request->branch,
        ]);

        if($store){
            $request->session()->flash('success', 'Bank has been added successfully...');
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
            'branch' => 'required',
        ]);

        //store the resource
        $update = Bank::where('id', $request->id)
                         ->update([
            
                                 'name' => $request->name,
                                 'branch' => $request->branch,

                                 ]);

        if($update){
            $request->session()->flash('success', 'Bank has been updated successfully...');
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
        
        $delete = Bank::where('id', $request->id)
                           ->delete();
        if($delete){

            $request->session()->flash('delete', 'Bank has been deleted successfully...');
            return back();
        }
        
    }
}
