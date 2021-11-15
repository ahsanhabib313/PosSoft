<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use PDF;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
 
        /*  //convert invoice html into pdf
         $pdf = App::make('dompdf.wrapper');

         //insert the html in a variable 
         $html = '';
         $html .= '<!DOCTYPE html>
         <html >
         <head>
           <meta >
           <meta http-equiv="X-UA-Compatible" content="IE=edge">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
         
           <style>
           @font-face {
             font-family: SutonnyMJ;
             src: url(storage_path(fonts/SutonnyMJ-Bold.ttf);
           }
         </style>
         </head>
         <body>
           <div>
                <div style="text-align: center;">
                  <h3 style="font-family: SutonnyMJ;">Tarak Vandar</h3>
                  <h4>Woner: Madob Lal Bonik</h4>
                  <h4>Kapriya Potri, Hajigonj Banzar, Hajigonj, Chandpur ।</h4>
                  <h4>Mobile: 01712-175016 </h4>
                </div> 
                <hr>  
                <div>
                  <h4>Order No: ';
        $html .= $order_id;
        $html .= '</h4><h4>Date: ';
        $html .= $order->created_at;
        $html .= '</h4> <h4>Customer Name: ';
        $html .= $customerName;
        $html .= ' </h4><h4>Mobile No: ';
        $html .= $mobileNumber;
        $html .= '</h4>
                        </div>
                        <hr>
                        <div style="margin:0 auto;">
                        <table  style="width:80%; border-collapse: collapse; text-align:center; ">
                            <thead>
                                <tr>
                                        <td>Product Name</td>
                                        <td>Quantity</td>
                                        <td>Price</td>
                                        <td>Unit Price</td>
                                        <td>Unit</td>
                                </tr>
                            </thead>
                            <tbody>';
        foreach($product_id as $item=> $value){ 
        
        $html .='<tr><td>';
        $html .=$productName[$item];
        $html .='</td><td>';
        $html .= $quantity[$item];
        $html .= '</td><td>';
        $html .= $productPrice[$item];
        $html .= '</td> <td>';
        $html .= $productUnitPrice[$item];
        $html .= '</td><td>';
        $html .= $productUnit[$item];
        $html .= '</td></tr>';

        }

        $html .= '<tr>
                    <td ></td>
                    <td colspan="2">Toal price</td>
                    <td colspan-"2>';
        $html .= $totalPrice;
        $html .= '</td>
                    </tr>
                     </tbody>
                    </table>
                    </divs>

                    </div>
                    </body>
                    </html>';

                    $pdf->loadHTML($html); */
                    //return $pdf->stream();

         return response()->json(true); 

          //return back()->with('success', 'অর্ডারটি সফলভাবে যুক্ত হয়েছে ');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
