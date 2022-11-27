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
    public function index(Request $request)
    {

         //get all categories
         $categories = Category::all();

        //check if the request comes from ajax
        if($request->ajax()){
            $category_html  = '';
            
            if(isset($categories)){

                foreach ($categories as $category){
                    $category_html .= '<div class="card" style="width: 7.3rem; margin-right:1%;height: 175px;max-height: 175px; cursor:pointer" onclick="getCompany('.$category->id.')">';
                    $category_html .= '<img class="card-img-top" src="'.asset('img/category/'.$category->image).'" alt="category image cap" style="height: 115px; max-height:115px ">';
                    $category_html .= '<div class="card-body">';                  
                    $category_html .= '<p class="card-text text-center" style="font-size: 12px">'.$category->name.'</p>';
                    $category_html .= '</div>';
                    $category_html .= '</div>';
                }
               
            }
 
            return response()->json([
             'category_html' => $category_html
             ]);
         }else{
                //get all units 
                $selling_types = SellType::all();
                return view('user.dashboard', compact('categories', 'selling_types'));

         }
             
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
        public function getCompany($category_id){

           $category = Category::find($category_id);
           $companies = json_decode($category->company_id);
           
           $company_html  = '';
           if(!is_null($companies)){
                  
                    foreach($companies as $company_id){

                        $company_html .='<div class="card" style="width: 7.3rem; margin-right:1%;height: 175px;max-height: 175px; cursor:pointer" data-category_id= "'.$category_id.'" data-company_id= "'.$company_id.'" onclick="getProduct(this)">';
                        $company_html .= '<img class="card-img-top" src="'.asset('img/company/'.Company::find($company_id)->logo).'" alt="company image cap" style="height: 115px; max-height:115px ">';
                        $company_html .= '<div class="card-body">';
                        $company_html .= '<p class="card-text text-center" style="font-size: 12px">'.Company::find($company_id)->name.'</p>';
                        $company_html .= '</div>';
                        $company_html .= '</div>';
                        
                       
                }

           return response()->json([
            'company_html' => $company_html
            ]);
        }else{
            return response()->json([
                'company_html' => $company_html
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
