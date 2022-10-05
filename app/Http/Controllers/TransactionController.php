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
        $merchants = Merchant::select('id','name')->get();
        $banks = Bank::select('id','name', 'branch')->get();
        $transactionTypes = TransactionType::select('id','name')->get();
        $transactions = Transaction::orderBy('id','desc')->get();
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

        //validate the forms input
        $request->validate([
            'merchant_id' => 'required',
            'transaction_type_id' => 'required',
            'amount' => 'required',
            'photo' => 'required|image|mimes:png,jpg,jpeg',
            'date' => 'required',
        ],[
            'merchant_id.required' => 'আড়ৎদার পূরণ হয় নি ',
            'transaction_type_id.required' => 'লেনদের প্রকার পূরণ হয় নি ',
            'bank_id.required' => 'লেনদের প্রকার পূরণ হয় নি ',
            'amount.required' => 'টাকার পরিমান পূরণ হয় নি ',
            'photo.required' => 'রশিদ পূরণ হয় নি ',
            'photo.image' => 'রশিদ ছবি ফরমেটের হবে',
            'photo.mimes' => 'রশিদের ছবি পিএনজি, জেপিজি, জেপিএজি ফরমেটের হবে ',
            'date.required' => 'তারিখ পূরণ হয় নি ',
        ]);

        if( $request->transaction_type_id == 1 ){
            $request->validate([
               
                'bank_id' => 'required',
              
                
            ]);
        }

        //move the photo in expected folder
        $photo = $request->photo;
        $photoName = time().'.'.$photo->getClientOriginalExtension();
        $path = public_path('img/transaction');
        $photo->move($path, $photoName);

        $store = Transaction::insert([
            'merchant_id' => $request->merchant_id,
            'transaction_type_id' => $request->transaction_type_id,
            'bank_id' => $request->bank_id,
            'amount' => $request->amount,
            'photo' => $photoName,
            'date' => $request->date,

        ]);

        if($store){
            return back()->with(['success' => 'লেনদেন সফলভাবে যোগ হয়েছে ']);
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

            'merchant_id' => 'required',
            'transaction_type_id' => 'required',
            'amount' => 'required',
            'photo' => 'required|image|mimes:png,jpg,jpeg',
            'date' => 'required',
            ],
            [
                'merchant_id.required' => 'আড়ৎদার পূরণ হয় নি ',
                'transaction_type_id.required' => 'লেনদের প্রকার পূরণ হয় নি ',
                'bank_id.required' => 'লেনদের প্রকার পূরণ হয় নি ',
                'amount.required' => 'টাকার পরিমান পূরণ হয় নি ',
                'photo.required' => 'রশিদ পূরণ হয় নি ',
                'photo.image' => 'রশিদ ছবি ফরমেটের হবে',
                'photo.mimes' => 'রশিদের ছবি পিএনজি, জেপিজি, জেপিএজি ফরমেটের হবে ',
                'date.required' => 'তারিখ পূরণ হয় নি ',
            ]);
        if($request->transaction_type_id == 1){
            $request->validate([
                'bank_id' => 'required',
                
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

   $transaction->merchant_id = $request->merchant_id;
   $transaction->transaction_type_id = $request->transaction_type_id;
   $transaction->bank_id = $request->bank_id;
   $transaction->amount = $request->amount;
   $transaction->date = $request->date;
  

   if(!empty($request->photo)){
    $transaction->photo = $photoName;
   }

   $store = $transaction->save();
   
   //store the resource in database table
   if($store){

       $request->session()->flash('success', 'লেনদেন সফলভাবে হালনাগাদ হয়েছে...');
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
            return back()->with('success','লেনদেন সফলভাবে বাতিল হয়েছে...');
        }
    }
}
