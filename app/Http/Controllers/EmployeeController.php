<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all designations
        $designations = Designation::all();
        
        //get all employees 
        $employees = Employee::orderBy('id', 'asc')->get();

        //get unread notification 
        $totalAlert = DB::table('notifications')->where('read_at', null)->count(); 

        return view('admin.employee', ['designations' => $designations, 'employees'=> $employees, 'totalAlert' => $totalAlert]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
    
         //validate the resource
         $request->validate([

            'name' => 'required',
            'designation_id' => 'required',
            'photo' => 'required|image|mimes:png,jpg',
            'phone' => 'required',
            'nid' => 'required',
            'salary' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'joining_date' => 'required|date',
            'is_leave' => 'required',
           
            
        ],[
            'name.required' => 'নাম পূরণ করা হয় নি',
            'designation_id.required' => 'পদবি পূরণ করা হয় নি',
            'photo.required' => 'ছবি পূরণ করা হয় নি',
            'phone.required' => 'মোবাইল নাম্বার পূরণ করা হয় নি',
            'nid.required' => 'জাতীয় পরিচয় নাম্বার পূরণ করা হয় নি',
            'salary.required' => 'বেতন পূরণ করা হয় নি',
            'gender.required' => 'লিঙ্গ পূরণ করা হয় নি',
            'address.required' => 'ঠিকানা পূরণ করা হয় নি',
            'joining_date.required' => 'যোগদানের তারিখ পূরণ করা হয় নি',
            'is_leave.required' => 'অবসর পূরণ করা হয় নি',
        ]);     

   
    $photo = $request->file('photo');
    $photoName = time().'.'.$photo->getClientOriginalExtension();
    $path = public_path('img/employees');
    $photo->move($path, $photoName);

   //store the resource in database table
   $store = Employee::create([

            'name' => $request->name,
            'designation_id' => $request->designation_id,
            'photo' => $photoName,
            'phone' => $request->phone,
            'nid' => $request->nid,
            'salary' => $request->salary,
            'gender' =>  $request->gender,
            'address' => $request->address,
            'joining_date' => $request->joining_date,
            'leaving_date' => $request->leaving_date,
            'is_leave' => $request->is_leave,
           
           

   ]);

   if($store){

       $request->session()->flash('success', 'কর্মচারী সাফল্যের সাথে যোগ হয়েছে...');
       return back();
   }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

         //validate the resource
         $request->validate([

            'name' => 'required',
            'designation_id' => 'required',
            'phone' => 'required',
            'nid' => 'required',
            'salary' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'joining_date' => 'required|date',
            'is_leave' => 'required',
           
            
        ],[
            [
                'name.required' => 'নাম পূরণ করা হয় নি',
                'designation_id.required' => 'পদবি পূরণ করা হয় নি',
                'phone.required' => 'মোবাইল নাম্বার পূরণ করা হয় নি',
                'nid.required' => 'জাতীয় পরিচয় নাম্বার পূরণ করা হয় নি',
                'salary.required' => 'বেতন পূরণ করা হয় নি',
                'gender.required' => 'লিঙ্গ পূরণ করা হয় নি',
                'address.required' => 'ঠিকানা পূরণ করা হয় নি',
                'joining_date.required' => 'যোগদানের তারিখ পূরণ করা হয় নি',
                'is_leave.required' => 'অবসর পূরণ করা হয় নি',
            ]
        ]); 
        
        if(!empty($request->photo)){
            $request->validate([
            'photo' => 'required|image|mimes:png,jpg',
            ],[
                
                'photo.required' => 'ছবি পূরণ করা হয় নি',
              
            ]);  
        } 
      

   if(!empty($request->photo)){

        $photo = $request->file('photo');
        $photoName = time().'.'.$photo->getClientOriginalExtension();
        $path = public_path('img/employees');
        $photo->move($path, $photoName);
   }

   //get the employee instance
   $employee = Employee::find($request->employee_id);

   $employee->name = $request->name;
   $employee->designation_id = $request->designation_id;
   $employee->phone = $request->phone;
   $employee->nid = $request->nid;
   $employee->salary = $request->salary;
   $employee->address = $request->address;
   $employee->joining_date = $request->joining_date;
   $employee->is_leave = $request->is_leave;
   $employee->leaving_date = $request->is_leave ==  'না' ? null : $request->leaving_date;

   if(!empty($request->photo)){
    $employee->photo = $photoName;
   }

   $store = $employee->save();
   
   //store the resource in database table
    if($store){

        $request->session()->flash('success', 'কর্মচারী সাফল্যের সাথে হালনাগাদ হয়েছে...');
        return back();
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $employee_id = $request->employee_id;
        
        //get the employee profile
        $employee = Employee::find($employee_id);
        //delete the employee profile
        $delete = $employee->delete();
        if($delete){
            return back()->with('success','কর্মচারী সাফল্যের সাথে বাতিল হয়েছে...');
        }
    }
}
