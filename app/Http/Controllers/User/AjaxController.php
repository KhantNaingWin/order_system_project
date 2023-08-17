<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzalist(Request $request){
        if ($request->status == 'asc') {
            $data=Product::orderBy('created_at','asc')->get();
        }else{
            $data=Product::orderBy('created_at','desc')->get();
        }
        return response()->json($data,200);

    }
    //return pizza list
    public function addToCart(Request $request){
        logger($request->all());
      $data=$this->getOrderData($request);
      Cart::create($data);
      $data=[
        'status'=>'status',
        'message'=>'message',
      ];
      return response()->json($data,200);
    }
    //order
    public function order(Request $request){
        $total=0;
        foreach ($request->all() as $item) {
           $data = OrderList::create([
                    'user_id'=>$item['user_id'],
                    'product_id'=>$item['product_id'],
                    'qty'=>$item['qty'],
                    'total'=>$item['total'] ,
                    'order_code'=>$item['order_code'],
                    ]);
                    $total+=$data->total;
        }
        Cart::where('user_id',Auth::user()->id)->delete();
        Order::create([
            'user_id'=>Auth::user()->id,
            'order_code'=>$data->order_code,
            'total_price'=>$total+3000,
        ]);

        return response()->json([
            'status'=>'true',
            'message'=>'order compeled',
        ],200);
    }
    //clear carts
    public function clearCarts(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }
    //clearCurrentProduct
    public function clearCurrentProduct(Request $request){
        Cart::where('user_id',Auth::user()->id)
                ->where('product_id',$request->productID)
                ->where('id',$request->orderID)->delete();
    }
    //Ajax View Count
    public function increaseViewCount(Request $request){
        $pizza=Product::where('id',$request->productId)->first();
        $count=[
            'view_count'=>$pizza->view_count + 1
        ];
        $pizza=Product::where('id',$request->productId)->update($count);
    }
    //Get Order Data
    private function getOrderData($request){
        return[
            'user_id'=>$request->userID,
            'product_id'=>$request->pizzaID,
            'qty'=>$request->count,
        ];
    }
}
