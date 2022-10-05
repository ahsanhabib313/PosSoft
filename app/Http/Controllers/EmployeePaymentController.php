<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees_payment = EmployeePayment::orderBy('id','desc')->paginate(5);
        $employees = Employee::orderBy('id', 'asc')->get();
        //get unread notification 
        $totalAlert = DB::table('notifications')->where('read_at', null)->count(); 

        return view('admin.employee_payment', compact('employees','employees_payment', 'totalAlert'));
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

       // dd($request->payment_date);
          //validate the resource
          $request->validate([

            'employee_id' => 'required',
            'payment_month' => 'required',
            'payment_year' => 'required',
            'photo' => 'required|image|mimes:png,jpg',
            'payment_date' => 'required|date',
           
        ]); 
        
        //check whether the payment already taken
        $paid = EmployeePayment::where('employee_id', $request->employee_id)
                                    ->where('payment_month', $request->payment_month)
                                    ->where('payment_year', $request->payment_year)
                                    ->first();


        if(!is_null($paid)){
           return back()->with('error', 'কর্মচারীর বেতন পূর্বেই যোগ করা হয়েছে...');
        }
        
    $photo = $request->file('photo');
    $photoName = time().'.'.$photo->getClientOriginalExtension();
    $path = public_path('img/employeePayment');
    $photo->move($path, $photoName);

   //store the resource in database table
   $store = EmployeePayment::create([

            'employee_id' => $request->employee_id,
            'payment_month' => $request->payment_month,
            'payment_year' => $request->payment_year,
            'photo' => $photoName,
            'payment_date' => $request->payment_date,
           
           

   ]);

   if($store){

       $request->session()->flash('success', 'কর্মচারীর বেতন সাফল্যের সাথে যোগ হয়েছে...');
       return back();
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeePayment  $employeePayment
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeePayment $employeePayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeePayment  $employeePayment
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeePayment $employeePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeePayment  $employeePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeePayment $employeePayment)
    {
         
          $request->validate([

            'employee_id' => 'required',
            'payment_month' => 'required',
            'payment_year' => 'required',
            'payment_date' => 'required|date',
           
        ]); 
        
        if(!empty($request->photo) ){
            $request->validate([
                'photo' => 'required|image|mimes:png,jpg,jpeg',
            ]);
        }
        
        if(!empty($request->photo)){

            $photo = $request->file('photo');
            $photoName = time().'.'.$photo->getClientOriginalExtension();
            $path = public_path('img/employeePayment');
            $photo->move($path, $photoName);
        }
     

        //store the resource in database table
         $employeePayment = EmployeePayment::find($request->id);
          
         $employeePayment->employee_id = $request->employee_id;
         $employeePayment->payment_month = $request->payment_month;
         $employeePayment->payment_year = $request->payment_year;
         $employeePayment->payment_date = $request->payment_date;

         if(!empty($request->photo)){
            $employeePayment->photo = $photoName;
         }
         $save = $employeePayment->save();

        if($save){

            $request->session()->flash('success', 'কর্মচারীর বেতন সাফল্যের সাথে হালনাগাদ করা হয়েছে...');
            return back();
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeePayment  $employeePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        
        //get the employee payment
        $employee_payment = EmployeePayment::find($id);

        //delete the employee payment
        $delete = $employee_payment->delete();
        if($delete){
            return back()->with('success','কর্মচারীর বেতন সাফল্যের সাথে বাতিল হয়েছে...');
        }
    }


    // search employee payemts history
    public function search(Request $request){

        $request->validate([

            'employee_id' => 'required'

        ],[
            'employee_id.required' => 'কর্মচারী ইনপুট পুরণ করা হয় নি ...!'
        ]);

        $employees_payment = EmployeePayment::where('employee_id', $request->employee_id)->orderBy('id', 'desc')->paginate(12);
        
        $employees = Employee::orderBy('id', 'asc')->get();

        //get unread notification 
        $totalAlert = DB::table('notifications')->where('read_at', null)->count(); 

        return view('admin.employee_payment', compact('employees','employees_payment', 'totalAlert'));



    }
}
