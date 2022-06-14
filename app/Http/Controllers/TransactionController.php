<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Merchant;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merchants = Merchant::select('name')->get();
        $banks = Bank::select('name', 'branch')->get();
        $transactionTypes = TransactionType::select('name')->get();
        $transactions = Transaction::orderBy('id','asc')->get();

          //get unread notification 
          $totalAlert = DB::table('notifications')->where('read_at', null)->count(); 

        return view('admin.transaction', compact('merchants','banks','transactionTypes','transactions','totalAlert'));
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

       // dd($request->all());

        //validate the forms input
        $request->validate([
            'merchant' => 'required',
            'transactionType' => 'required',
            'amount' => 'required|numeric',
            'photo' => 'required|image|mimes:png,jpg,jpeg',
            'date' => 'required',
        ]);

        if(strtolower( $request->bank) =='bank'){
            $request->validate([
               
                'bank' => 'required',
                'branch' => 'required',
                
            ]);
        }

        //move the photo in expected folder
        $photo = $request->photo;
        $photoName = time().'.'.$photo->getClientOriginalExtension();
        $path = public_path('img/transaction');
        $photo->move($path, $photoName);

        $store = Transaction::insert([
            'merchant' => $request->merchant,
            'transactionType' => $request->transactionType,
            'bank' => $request->bank,
            'branch' => $request->branch,
            'amount' => $request->amount,
            'photo' => $photoName,
            'date' => $request->date,

        ]);

        if($store){
            return back()->with(['success' => 'Transaction has been added successfully']);
        }else{
            return back()->with(['error' => 'Transaction has been added Fail']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->id);
        //validate the resource
        $request->validate([

            'merchant' => 'required',
            'transactionType' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required',
            
           
            
        ]); 
        if(strtolower($request->transactionType) == 'bank'){
            $request->validate([
                'bank' => 'required|numeric',
                'branch' => 'required|numeric',
            ]);
        }
        
        if(!empty($request->photo)){
            $request->validate([
            'photo' => 'required|image|mimes:png,jpg',
            ]);  
        } 
      

   if(!empty($request->photo)){

        $photo = $request->file('photo');
        $photoName = time().'.'.$photo->getClientOriginalExtension();
        $path = public_path('img/transaction');
        $photo->move($path, $photoName);
   }

   //get the employee instance
   $transaction = Transaction::find($request->id);

   $transaction->merchant = $request->merchant;
   $transaction->transactionType = $request->transactionType;
   $transaction->bank = $request->bank;
   $transaction->branch = $request->branch;
   $transaction->amount = $request->amount;
   $transaction->date = $request->date;
  

   if(!empty($request->photo)){
    $transaction->photo = $photoName;
   }

   $store = $transaction->save();
   
   //store the resource in database table
   if($store){

       $request->session()->flash('success', 'Transaction has been Updated successfully...');
       return back();
   }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        
        //get the employee profile
        $transaction = Transaction::find($id);

        //delete the employee profile
        $delete = $transaction->delete();
        if($delete){
            return back()->with('success','Transaction has been deleted successfully ...');
        }
    }
}
