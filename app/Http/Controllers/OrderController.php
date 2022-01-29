<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Customer;
use App\Models\SellType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use PDF;

class OrderController extends Controller
{
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  

        $customerName     = $request->customerName;
        $mobileNumber     = $request->mobileNumber;
        $productName      = $request->productName ;
        $product_id       = $request->product_id;
        $quantity         = $request->quantity;
        $sell_type_id     = $request->sell_type_id;
        $manufacture      = $request->manufacture;
        $productPrice     = $request->productPrice;
        $productUnitPrice = $request->productUnitPrice;
        $productUnit      = $request->productUnit;
        $totalPrice       = $request->totalPrice;
        $debit            = $request->debit;
        
        //convert string to array

        $productName = explode(',', $productName);
        $product_id = explode(',', $product_id);
        $quantity = explode(',', $quantity);
        $sell_type_id = explode(',', $sell_type_id);
        $manufacture = explode(',', $manufacture);
        $productPrice = explode(',', $productPrice);
        $productUnitPrice = explode(',', $productUnitPrice);
        $productUnit = explode(',', $productUnit);

       
          if($mobileNumber != NULL && $debit != NULL){

            $customer = Customer::where('mobile', $mobileNumber)->first();
             if($customer){

                Customer::where('id', $customer->id)
                        ->update([

                                'debit'  => $debit
                ]);
            }else{

                Customer::create([
                                'mobile' => $mobileNumber,
                                'name'   => $customerName,
                                'credit' => null,
                                'debit'  => $debit
                ]);
            }
            
        } 

         //store the order table
         $order_id = Order::create([
             'customerName' => $customerName,
             'mobileNumber' => $mobileNumber,
             'totalPrice'   => $totalPrice
         ])->id;
         
         $order = Order::find($order_id);

         //store the product item
         foreach($product_id as $item => $value){
             
            OrderItem::create([
                 
                'order_id' => $order_id,
                'product_id' => $product_id[$item],
                'sell_type_id' => $sell_type_id[$item],
                'quantity' => $quantity[$item],
                'manufacture' => $manufacture[$item],
                'productPrice' => $productPrice[$item],
                'productUnitPrice' => $productUnitPrice[$item],
                'productUnit' => $productUnit[$item]

            ]);

            $product = Product::find( $product_id[$item]);

            if( $manufacture[$item] == 0 && $sell_type_id[$item] == 1 ){
             
                $weightPerUnit = (float)$product->productWeight;
                $sellQuantity = (float)$quantity[$item]/(float)$weightPerUnit;
                $restQuantity = (float)$product->quantity - (float)$sellQuantity;

            }else{

                (float)$restQuantity = (float)$product->quantity - (float)$quantity[$item];
            }

            Product::where('id', $product_id[$item])
                    ->update([
                         'quantity' => $restQuantity
                    ]);

         }   
         return response()->json(true); 

          
    }

  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function searchDebit(Request $request)
    {
        $mobileNumber = $request->mobileNumber;

        $customer = Customer::where('mobile', $mobileNumber)->first();
        if($customer){

            $pastDebit = $customer->debit;
            return response()->json($pastDebit);
        }else{
            return response()->json(0);
        }

       

    }

    //get the invoice pdf
    public function getInvoice(Request $request){

        //get the last order
        $order = Order::orderBy('id','desc')->first();
        //get the order item 
        $order_items = OrderItem::with('product')->where('order_id', $order->id)->get();
    
        return response()->json([
            'order' => $order,
            'order_items' => $order_items
        ]);
    }

   
}
