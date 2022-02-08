<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use App\Models\ProductPlace;
use App\Models\SellType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        
        $value = $request->value;

        if($request->ajax()){
            if($value !=''){
                $products =Product::where('productName','like', '%'.$value.'%')
                ->orWhere('companyName','like', '%'.$value.'%')
                ->orWhere('barCode','like', '%'.$value.'%')
                ->orWhere('category_id','like', '%'.$value.'%')
                ->get();
            }

          
           
        }
        //get the products
        $products = Product::simplePaginate(10);
        //get the category
        $categories = Category::all();
         //get all units
         $units = Unit::all();
     
        return view('admin.product', compact('products','categories', 'units'));
    }

    //store the resources 
    public function store(Request $request){

            //validate the resource
            $request->validate([
                'manufacture' => 'required',
                'productName' => 'required',
                'photo' => 'required',
                'category_id' => 'required',
                'companyName' => 'required',
                'productWeight' => 'required',
                'productWeightUnit' => 'required',
                'buyingPrice' => 'required',
                'retailPrice' => 'required',
                'wholesalePrice' => 'required',
                'quantity' => 'required',
                'productQuantityUnit' => 'required',
                'alertQuantity' => 'required',
                'barCode' => 'required|unique:products',
                'expireDate' => 'required',
                
            ]);     

       
        $photo = $request->file('photo');
        $photoName = time().'.'.$photo->getClientOriginalExtension();
        $path = public_path('img/products');
        $photo->move($path, $photoName);
    
       //store the resource in database table
       $store = Product::create([

                'manufacture' => $request->manufacture,
                'productName' => $request->productName,
                'photo' => $photoName,
                'category_id' => $request->category_id,
                'companyName' => $request->companyName,
                'productWeight' => $request->productWeight,
                'productWeightUnit' =>  $request->productWeightUnit,
                'buyingPrice' => $request->buyingPrice,
                'retailPrice' => $request->retailPrice,
                'wholesalePrice' => $request->wholesalePrice,
                'quantity' => $request->quantity,
                'productQuantityUnit' => $request->productQuantityUnit,
                'alertQuantity' => $request->alertQuantity,
                'barCode' => $request->barCode,
                'expireDate' => $request->expireDate,
               

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
            'photo' => 'required',
            'category_id' => 'required',
            'companyName' => 'required',
            'productWeight' => 'required',
            'productWeightUnit' => 'required',
            'buyingPrice' => 'required',
            'retailPrice' => 'required',
            'wholesalePrice' => 'required',
            'quantity' => 'required',
            'productQuantityUnit' => 'required',
            'alertQuantity' => 'required',
            'barCode' => 'required|unique:products',
            'expireDate' => 'required',
            
        ]);     

   
    $photo = $request->file('photo');
    $photoName = time().'.'.$photo->getClientOriginalExtension();
    $path = public_path('img/products');
    $photo->move($path, $photoName);

   //store the resource in database table
   $store = Product::create([

            'manufacture' => $request->manufacture,
            'productName' => $request->productName,
            'photo' => $photoName,
            'category_id' => $request->category_id,
            'companyName' => $request->companyName,
            'productWeight' => $request->productWeight,
            'productWeightUnit' =>  $request->productWeightUnit,
            'buyingPrice' => $request->buyingPrice,
            'retailPrice' => $request->retailPrice,
            'wholesalePrice' => $request->wholesalePrice,
            'quantity' => $request->quantity,
            'productQuantityUnit' => $request->productQuantityUnit,
            'alertQuantity' => $request->alertQuantity,
            'barCode' => $request->barCode,
            'expireDate' => $request->expireDate,
           

   ]);

   if($store){

       $request->session()->flash('success', 'আপনার পণ্য সফলভাবে যোগ হয়েছে...');
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
                    'unit' =>$product->productQuantityUnit
                ];
                
                return response()->json($data);

          }else{

                $data = [
                    'id'=>$product->id,
                    'price' => $product->retailPrice,
                    'unit' =>$product->productWeightUnit
                ];
                
                return response()->json($data);
                
          }
          
      }
      if($sell_type_id == 2){

        $data = [
            'id'=>$product->id,
            'price' => $product->wholesalePrice,
            'unit' =>$product->productQuantityUnit
        ];

        return response()->json($data);

      }
}








}
