<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\Unit;
use App\Models\ProductPlace;
use App\Models\SellType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request){
       
        //get the products
        $products = Product::paginate(10);
        //get the category
        $categories = Category::all();
         //get all units
         $units = Unit::all();

        //get all companies
        $companies = Company::all();

           //get unread notification 
        $totalAlert = DB::table('notifications')->where('read_at', null)->count(); 
     
        return view('admin.product', compact('products','categories', 'units', 'totalAlert','companies'));
    }

    //store the resources 
    public function store(Request $request){
          
            //validate the resource
            $request->validate([
                'manufacture' => 'required',
                'productName' => 'required',
                'photo' => 'required',
                'category_id' => 'required',
                'company_id' => 'required',
                'productWeight' => 'required',
                'productWeightUnit' => 'required',
                'buyingPrice' => 'required',
                'retailPrice' => 'required',
                'wholesalePrice' => 'required',
                'quantity' => 'required',
                'productQuantityUnit' => 'required',
                'alertQuantity' => 'required',
                'barCode' => 'required|unique:products',
                'produceDate' => 'required',
                'expireDate' => 'required',
                
            ],[
                'productName.required'=> 'পণ্যের নাম পূরণ হয় নি',
                'photo.required'=> 'ছবি পূরণ করা হয় নি',
                'category_id.required' => 'ক্যাটাগরি বাছাই করা হয় নি',
                'company_id.required' =>'কোম্পানীর নাম পুরণ করা হয় নি',
                'productWeight.required' =>'পণ্যের ওজন পূরণ করা হয় নি ',
                'productWeightUnit.required' =>'পণ্যের ওজনের একক পূরণ করা হয় নি',
                'buyingPrice.required' =>'ক্রয়মূল্য পূরণ করা হয় নি',
                'retailPrice.required' =>'খুচরা মূল্য পূরণ করা হয় নি',
                'wholesalePrice.required' =>'পাইকারি মূল্য পূরণ করা হয় নি',
                'quantity.required' =>'পণ্যের সংখ্যা পুরণ করা হয় নি ',
                'productQuantityUnit.required' => 'পণ্যের সংখ্যার একক পূরণ করা হয় নি',
                'alertQuantity.required'=>'পণ্যের সতর্ককরণ সংখ্যা পুরণ করা হয় নি ',
                'barCode.required' =>'বারকোড পূরণ করা হয় নি ',
                'barCode.unique' => 'বারকোড অদ্বিতীয় হতে হবে',
                'produceDate.required'=>'পণ্যের উৎপাদন তারিখ পূরণ করা হয় নি',
                'expireDate.required'=>'পণ্যের মেয়াদোত্তীর্ণ তারিখ পূরণ করা হয় নি',
            ]);     

       
        $photo = $request->file('photo');
        $photoName = time().'.'.$photo->getClientOriginalExtension();
        $path = public_path('img/products');
        $photo->move($path, $photoName);
        
        //evaluate the profit according  to manufacture
        if($request->manufacture == 0){
              
               $perUnitBuyingPrice = ($request->buyingPrice / $request->productWeight);
       
               $retailProfit = $request->retailPrice - $perUnitBuyingPrice;
        }else{
               $retailProfit = $request->retailPrice - $request->buyingPrice;
        }
   
    
       //store the resource in database table
       $store = Product::create([

                'manufacture' => $request->manufacture,
                'productName' => $request->productName,
                'photo' => $photoName,
                'category_id' => $request->category_id,
                'company_id' => $request->company_id,
                'productWeight' => $request->productWeight,
                'productWeightUnit' =>  $request->productWeightUnit,
                'buyingPrice' => $request->buyingPrice,
                'retailPrice' => $request->retailPrice,
                'wholesalePrice' => $request->wholesalePrice,
                'quantity' => $request->quantity,
                'productQuantityUnit' => $request->productQuantityUnit,
                'alertQuantity' => $request->alertQuantity,
                'barCode' => $request->barCode,
                'produceDate' => $request->produceDate,
                'expireDate' => $request->expireDate,
                'retailProfit' => $retailProfit,
                'wholesaleProfit' => $request->wholesalePrice - $request->buyingPrice,
               

       ]);

       if($store){

           $request->session()->flash('success', 'আপনার পণ্য সফলভাবে যোগ হয়েছে...');
           return back();
       }

    }

     //store the resources 
     public function update(Request $request){
        
        //validate the resource
        $request->validate([
            
            'productName' => 'required',
            'category_id' => 'required',
            'company_id' => 'required',
            'productWeight' => 'required',
            'productWeightUnit' => 'required',
            'buyingPrice' => 'required',
            'retailPrice' => 'required',
            'wholesalePrice' => 'required',
            'quantity' => 'required',
            'productQuantityUnit' => 'required',
            'alertQuantity' => 'required',
            'produceDate' => 'required',
            'expireDate' => 'required',
            
        ],[
            'productName.required'=> 'পণ্যের নাম পূরণ হয় নি',
            'photo.required'=> 'ছবি পূরণ করা হয় নি',
            'category_id.required' => 'ক্যাটাগরি বাছাই করা হয় নি',
            'company_id.required' =>'কোম্পানীর নাম পুরণ করা হয় নি',
            'productWeight.required' =>'পণ্যের ওজন পূরণ করা হয় নি ',
            'productWeightUnit.required' =>'পণ্যের ওজনের একক পূরণ করা হয় নি',
            'buyingPrice.required' =>'ক্রয়মূল্য পূরণ করা হয় নি',
            'retailPrice.required' =>'খুচরা মূল্য পূরণ করা হয় নি',
            'wholesalePrice.required' =>'পাইকারি মূল্য পূরণ করা হয় নি',
            'quantity.required' =>'পণ্যের সংখ্যা পুরণ করা হয় নি ',
            'productQuantityUnit.required' => 'পণ্যের সংখ্যার একক পূরণ করা হয় নি',
            'alertQuantity.required'=>'পণ্যের সতর্ককরণ সংখ্যা পুরণ করা হয় নি ',
            'produceDate.required'=>'পণ্যের উৎপাদন তারিখ পূরণ করা হয় নি',
            'expireDate.required'=>'পণ্যের মেয়াদোত্তীর্ণ তারিখ পূরণ করা হয় নি',
        ]);  


         //evaluate the profit according  to manufacture
         if($request->manufacture == 0){
              
            $perUnitBuyingPrice = ($request->buyingPrice / $request->productWeight);
    
            $retailProfit = $request->retailPrice - $perUnitBuyingPrice;
     }else{
            $retailProfit = $request->retailPrice - $request->buyingPrice;
     }
        
        
         //store the resource in database table
        $product = Product::find($request->product_id);

        $product->productName = $request->productName;
        $product->category_id = $request->category_id;
        $product->company_id = $request->company_id;
        $product->productWeight = $request->productWeight;
        $product->productWeightUnit =  $request->productWeightUnit;
        $product->buyingPrice = $request->buyingPrice;
        $product->retailPrice = $request->retailPrice;
        $product->wholesalePrice = $request->wholesalePrice;
        $product->quantity = $request->quantity;
        $product->productQuantityUnit = $request->productQuantityUnit;
        $product->alertQuantity = $request->alertQuantity;
        $product->produceDate = $request->produceDate;
        $product->expireDate = $request->expireDate;
        $product->retailProfit = $retailProfit;
        $product->wholesaleProfit = $request->wholesalePrice - $request->buyingPrice;
        

        //check if photo uploaded
        if($request->hasFile('photo')){

            $photo = $request->file('photo');
            $photoName = time().'.'.$photo->getClientOriginalExtension();
            $path = public_path('img/products');
            $photo->move($path, $photoName);
            $product->photo = $photoName;
        
        }
       $store = $product->save();

   if($store){
       $request->session()->flash('success', 'আপনার পণ্য সফলভাবে সংশোধন হয়েছে...');
       return back();
   }

}

//product delete function 
public function destroy(Request $request){
    
     $product = Product::find($request->product_id);
     $delete = $product->delete();

     if($delete){
       $request->session()->flash('success', 'আপনার পণ্য সফলভাবে বাতিল হয়েছে...');
       return back();
     }

}

 // search order items acording to bar code
 public function searchOrderItem(Request $request){
         
    //get the input value 
     $barCode = $request->barCode;
     //search the product with barcode
     $product = Product::where('barCode', $barCode)->first();
     //get the sell type
     $sellType = SellType::all();
     
     if($product && $sellType){
        return response()->json([$product, $sellType]);
     }else{
         return response()->json(false);
     }
   
}

//get the product whole sale price using product id 
public function productWholesalePrice(Request $request){

      $sell_type_id = $request->sell_type_id;
      $product_id = $request->product_id;

      //get the product 
      $product = Product::findOrFail($product_id);

      if($sell_type_id == 1){
          if($product->manufacture == 1){

                $data = [
                    'id'=>$product->id,
                    'price' => $product->retailPrice,
                    'unit' =>$product->productQuantityUnit,
                    'profit' =>$product->retailProfit
                ];
                
                return response()->json($data);

          }else{

                $data = [
                    'id'=>$product->id,
                    'price' => $product->retailPrice,
                    'unit' =>$product->productWeightUnit,
                    'profit' =>$product->retailProfit
                ];
                
                return response()->json($data);
                
          }
          
      }
      if($sell_type_id == 2){

        $data = [
            'id'=>$product->id,
            'price' => $product->wholesalePrice,
            'unit' =>$product->productQuantityUnit,
            'profit' =>$product->wholesaleProfit
        ];

        return response()->json($data);

      }
}

/**++++++++++++++++++++ search product ++++++++++++++++++++++++ */

public function search(Request $request){
  
    $search_value = $request->value;
   
        // get the value
        if(!is_null($search_value)){

            $products =Product::where('productName','like', '%'.$search_value.'%')
            ->orWhere('barCode', $search_value)
            ->orWhere('category_id', $search_value)
            ->simplePaginate(10);  
           
        }else{
            $products =Product::all();
        }

        $html = ' ';
        $loop = 0;
        foreach($products as $product){

     
            $html .= '<tr><td>'. ++$loop .'</td><td>'.$product->productName.'</td><td>'.$product->companyName.'</td>';
            $html .= '<td>'.$product->category->name.'</td><td><img src="'.asset('img/products/').'/'.$product->photo.'"';
            $html .= 'alt="" height="40" width="40">  </td>';
            $html .= '<td><a href="" onclick="viewProduct('.$product->id.')" ';
            $html .= 'class="btn btn-sm btn-warning text-light  d-inline-block mb-1"';
            $html .= 'data-toggle="modal" data-target="#viewProduct"><i class="fas fa-eye"></i></a>';
            $html .= '<a href="" onclick="editProduct('.$product->id.')" class="btn btn-sm btn-info d-inline-block mb-1"';
            $html .= ' data-toggle="modal" data-target="#editProduct"><i class="far fa-edit"></i></a>';
            $html .= '<a href="" onclick="deleteProduct('.$product->id.')" class="btn btn-sm btn-danger d-inline-block mb-1"';
            $html .= 'data-toggle="modal" data-target="#deleteProduct"><i class="far  fa-trash-alt"></i></a></td></tr>';

            
            $html .= '<input type="hidden" class="productName_'.$product->id.'" value="'.$product->productName.'">';
            $html .= '<input type="hidden" class="photo_'.$product->id.'" value="'. $product->photo.'">';
            $html .= '<input type="hidden" class="category_'.$product->id.'" value="'.$product->category->name.'">';
            $html .= '<input type="hidden" class="companyName_'.$product->id.'" value="'.$product->companyName.'">';
            $html .= '<input type="hidden" class="productWeight_'.$product->id.'" value="'.$product->productWeight.'">';
            $html .= '<input type="hidden" class="productWeightUnit_'.$product->id.'" value="'.$product->productWeightUnit.'">';
            $html .= '<input type="hidden" class="buyingPrice_'.$product->id.'" value="'.$product->buyingPrice.'">';
            $html .= '<input type="hidden" class="retailPrice_'.$product->id.'" value="'.$product->retailPrice.'">';
            $html .= '<input type="hidden" class="wholesalePrice_'.$product->id.'" value="'.$product->wholesalePrice.'">';
            $html .= '<input type="hidden" class="quantity_'.$product->id.'" value="'.$product->quantity.'">';
            $html .= '<input type="hidden" class="productQuantityUnit_'.$product->id.'" value="'.$product->productQuantityUnit.'">';
            $html .= '<input type="hidden" class="alertQuantity_'.$product->id.'" value="'.$product->alertQuantity.'">';
            $html .= '<input type="hidden" class="barCode_'.$product->id.'" value="'.$product->barCode.'">';
            $html .= '<input type="hidden" class="expireDate_'.$product->id.'" value="'.$product->expireDate.'">';
            $html .= '<input type="hidden" class="buyingDate_'.$product->id.'" value="'.$product->updated_at.'">'; 


        }

        return response()->json([
            'table_data' => $html
        ]);

    }

    
    //fetch the company according to category
    public function getCompany($category_id){

        $category = Category::find($category_id);
        $companies = json_decode($category->company_id);
        
        $company_html  = '';

        if(!is_null($companies)){
                
                $company_html .= '<option selected disabled>বাছাই করুন</option>';
                foreach($companies as $company_id){

                    $company_html .= '<option value="'.$company_id.'">'.Company::find($company_id)->name.'</option>';

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

}
