<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DraftOrder;
use App\Models\DraftOrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class DraftOrderController extends Controller
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
         $order_id = DraftOrder::create([
             'customerName' => $customerName,
             'mobileNumber' => $mobileNumber,
             'totalPrice'   => $totalPrice
         ])->id;
         
         $order = DraftOrder::find($order_id);

         //store the product item
         foreach($product_id as $item => $value){
             
            DraftOrderItem::create([
                 
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
     * @param  \App\Models\DraftOrder  $draftOrder
     * @return \Illuminate\Http\Response
     */
    public function show(DraftOrder $draftOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DraftOrder  $draftOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(DraftOrder $draftOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DraftOrder  $draftOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DraftOrder $draftOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DraftOrder  $draftOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(DraftOrder $draftOrder)
    {
        //
    }
}
