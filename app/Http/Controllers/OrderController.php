<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Customer;
use App\Models\SellType;
use App\Notifications\CustomNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class OrderController extends Controller
{

    //show all orders 
    public function index(){
        //get all data
        $orders = Order::orderBy('id','desc')->paginate(10);
          //get unread notification 
          $totalAlert = DB::table('notifications')->where('read_at', null)->count(); 
        return view('admin.order', ['orders'=>$orders, 'totalAlert' => $totalAlert]);

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

                                'name' =>$customerName,
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
             'totalPrice'   => $totalPrice,
            
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

            //update item quantity

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

            $name = $customer->name;
            $pastDebit = $customer->debit;
            $debitDate = $customer->created_at;
            $debitDate = date('d-m-Y', strtotime($debitDate));
           
            return response()->json([
                'name' => $name,
                'pastDebit' => $pastDebit,
                'debitDate' => $debitDate,
            ]);
        }else{
            return response()->json([
                'name' => '',
                'pastDebit' => 0,
                'debitDate' => '',
            ]);
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

    public function search(Request $request){
        
        $search_value = $request->value;

        //dd( date('Y-m-d', strtotime($search_value)));
        // get the value
        if(!empty($search_value)){

            $orders =Order::where('id', $search_value)
                            ->orWhere('created_at', 'like', '%'.date('Y-m-d', strtotime($search_value)).'%')
                            ->orWhere('mobileNumber', $search_value)
                            ->get();  
           
        }

        $html = ' ';
        $loop = 0;
        foreach($orders as $order){

     
            $html .= '<tr><td>'.$order->id.'</td><td>'.$order->customerName.'</td>';
            $html .= '<td>'.$order->mobileNumber.'</td><td>'.$order->totalPrice.'</td> <td>'. date('Y-m-d h:i:s A', strtotime( $order->created_at)).'</td>';
            $html .= '<td><a href="" onclick="viewProduct('.$order->id.')" ';
            $html .= 'class="btn btn-sm btn-warning text-light  d-inline-block mb-1"';
            $html .= 'data-toggle="modal" data-target="#viewProduct"><i class="fas fa-eye"></i></a>';
            $html .= '<a href="" onclick="editProduct('.$order->id.')" class="btn btn-sm btn-info d-inline-block mb-1"';
            $html .= ' data-toggle="modal" data-target="#editProduct"><i class="far fa-edit"></i></a>';
            $html .= '<a href="" onclick="deleteProduct('.$order->id.')" class="btn btn-sm btn-danger d-inline-block mb-1"';
            $html .= 'data-toggle="modal" data-target="#deleteProduct"><i class="far  fa-trash-alt"></i></a></td></tr>';

        }

        return response()->json([
            'table_data' => $html
        ]);

    }

    public function viewOrderItems(Request $request, $id){

       //get the order items
       $order_items = OrderItem::where('order_id', $id)->get();

       $order_item_tr = '';

       foreach($order_items as $order_item){

           $order_item_tr .= '<tr>
                              <td>'.$order_item->product->productName.'</td>
                              <td>'.$order_item->sellType->name.'</td>
                              <td>'.$order_item->quantity.'</td>
                              <td>'.$order_item->productUnit.'</td>
                              <td>'.$order_item->productPrice.'</td>
                              <td>'.$order_item->productUnitPrice.'</td>
                             
                     </tr>';

       }

       return response()->json($order_item_tr);



    }

    // delete order
    public function destroy(Request $request){
        
        //get the order id
        $order_id = $request->id;

        if(!empty($order_id)){

            $order_items = OrderItem::where('order_id', $order_id)->get();

            foreach($order_items as $order_item){
                $order_item->delete();
            }
    
            $order = Order::find($order_id);
            $delete = $order->delete();

            if($delete){
                return response()->json(true);
            }
        }
        

    }

   
}
