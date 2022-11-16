<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\SellType;
use App\Models\Unit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all units 
        $selling_types = SellType::all();
        //get the categories
        $categories = Category::all();
        //get the companies
        $companies = Company::all();
        

        return view('user.dashboard', compact('categories', 'selling_types','companies'));
    }



    //get the product according to category
    public function getProduct(Request $request){

        //get the request data
        $category_id = $request->category_id;
        $company_id = $request->company_id;
        //get the products according to category
        $products = Product::where('category_id', $category_id)
                             ->where('company_id', $company_id)->get();

        
        if(count($products) > 0){
            return response()->json([
                'status' => 'true',
                'products' => $products,
            ]);
        }else{
            return response()->json([
                'status' => 'false',
                'products' => 'কোন পণ্য পাওয়া যায় নি!',
            ]);
        }
      
    }


 //fetch the company according to category

        public function getCompany($id){

           $category = Category::find($id);
           $companies = json_decode($category->company_id);
           
           $option = '';
           if(!is_null($companies)){
                    foreach($companies as $company_id){
                        
                        $option .='<option value="'.$company_id.'">'.Company::find($company_id)->name.'</option>';
                }

           return response()->json([
            'option' => $option
            ]);
        }else{
            return response()->json([
                'option' => $option
                ]);
        }
           
      
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
