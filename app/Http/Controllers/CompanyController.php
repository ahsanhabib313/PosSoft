<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class CompanyController extends Controller
{

    /**
     * 
     * 
     * search of the resource
     * 
     */

     public function search(Request $request){

        $search_value = $request->value;
        // get the value
        if($search_value !=''){

            $companies =Company::where('name','like', '%'.$search_value.'%')
            ->simplePaginate(10);  
           
        }

        $html = ' ';
        $loop = 0;
        foreach($companies as $company){

           $html .='<tr>
           <td>'.++$loop.'</td>
           <td class="companyName_'.$company->id.'">'.$company->name.'</td>
           <td><img  class="companyLogo_'. $company->id.'" width="50" height="50" src="'.asset('/img/company/'.$company->logo).'"></td>
           <td>
           <button class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editCompany"  onclick="editFunction('.$company->id.')">Edit</button>
           <button class="btn btn-sm btn-danger d-inline-block" data-toggle="modal" data-target="#deleteCompany"  onclick="deleteFunction('.$company->id.')">Delete</button>
           </td></tr>';
        }

        return response()->json([
           'company' => $html 
        ]);
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //get unread notification 
        $totalAlert = DB::table('notifications')->where('read_at', null)->count();
        $companies = Company::paginate(10);

        return view('admin.company', compact('companies','totalAlert'));
       
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
        //validate the input
        $request->validate([
            'name' => 'required',
            'logo' => 'required'
        ],[
            'name.required' => 'কোম্পানীর নাম পূরণ করা হয় নি',
            'logo.required' => 'কোম্পানীর লোগো পূরণ করা হয় নি',
           
        ]);
     
        $photo = $request->file('logo');
        $photoName = time().'.'.$photo->getClientOriginalExtension();
        $path = public_path('img/company');
        $photo->move($path, $photoName);
 
        $store = Company::create([

            'name' => $request->name,
            'logo' => $photoName

        ]);

        if($store){
            $request->session()->flash('success', 'আপনার কোম্পানী সাফল্যের সাথে যোগ হয়েছে...');
            return back();
        }else{
            $request->session()->flash('fail', 'আপনার কোম্পানী যোগ হয় নি...');
            return back();
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {

        //get the company 
        $company = Company::find($request->id);
        
        $company->name = $request->name;
        
      if($request->hasFile('logo')){

            $photo = $request->file('logo');
            $photoName = time().'.'.$photo->getClientOriginalExtension();
            $path = public_path('img/company');
            $photo->move($path, $photoName);
            $company->logo = $photoName;
        
        }
   
       $update = $company->save(); 

       if($update){
        $request->session()->flash('success', 'আপনার কোম্পানী সাফল্যের সাথে সংশোধন হয়েছে...');
        return back();
    }else{
        $request->session()->flash('fail', 'আপনার কোম্পানী সংশোধন হয় নি...');
        return back();
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Company $company)
    {
        
        //find the expected company
        $company = Company::find($request->id);

        //delete the company
        $delete = $company->delete();
   
        if($delete){
          $request->session()->flash('success', 'আপনার কোম্পানী সফলভাবে বাতিল হয়েছে...');
          return back();
        }
    }
}
