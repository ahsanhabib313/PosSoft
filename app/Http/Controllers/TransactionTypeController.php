<?php

namespace App\Http\Controllers;

use App\Models\TransactionType;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TransactionTypeController extends Controller
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
        $transactionTypes = TransactionType::paginate(10);
        return view('admin.transactionType', compact('transactionTypes','totalAlert'));
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
        ],
        [
            'name.required' => 'লেনদেন প্রকারের নাম পূরণ করা হয় নি ',
        ]);

        //store the resource
        $store = TransactionType::create([
            
             'name' => $request->name,
        ]);

        if($store){
            $request->session()->flash('success', 'আপনার ক্যাটাগরি সাফল্যের সাথে যোগ হয়েছে...');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
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
        ], [
            'name.required' => 'লেনদেনের প্রকার পূরণ করা হয় নি ',
        ]);

        //store the resource
        $update = TransactionType::where('id', $request->transactionType_id)
                         ->update([
            
                                 'name' => $request->name,
                                 ]);

        if($update){
            $request->session()->flash('success', 'আপনার লেনদেন সাফল্যের সাথে সংশোধন হয়েছে...');
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
        
        $delete = TransactionType::where('id', $request->transactionType_id)
                           ->delete();
        if($delete){

            $request->session()->flash('delete', 'আপনার ক্যাটাগরি সাফল্যের সাথে বাতিল হয়েছে...');
            return back();
        }
        
    }


    /**=========================== Category Search method ====================== */
    public function search(Request $request){

        $search_value = $request->value;

        // get the value
        if($search_value !=''){

            $transactionTypes =TransactionType::where('name','like', '%'.$search_value.'%')
            ->simplePaginate(10);  
           
        }

        $html = ' ';
        $loop = 0;
        foreach($transactionTypes as $transactionType){

            $html .='<tr>
            <td>'.++$loop.'</td>
            <td class="transactionType_'.$transactionType->id.'">'.$transactionType->name.'</td>
           <td>
           <button class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editModal"  onclick="editFunction('.$transactionType->id.')">সংস্করণ</button>
           <button class="btn btn-sm btn-danger d-inline-block" data-toggle="modal" data-target="#deleteModal"  onclick="deleteFunction('.$transactionType->id.')">বাতিল</button>
           </td></tr>';
        }

        return response()->json([
           'category' => $html 
        ]);
    }
}
