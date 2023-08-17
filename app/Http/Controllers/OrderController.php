<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //order list
    public function orderList(){
        $order=Order::select('orders.*','users.name')
        ->leftJoin('users','users.id','orders.user_id')
        ->when(request('key'),function($query){
            $query->orWhere('users.name','like','%'.request('key').'%')
                    ->orWhere('orders.order_code','like','%'.request('key').'%')
                    ->orWhere('orders.total_price','like','%'.request('key').'%');
        })
        ->orderBy('created_at','desc')
        ->paginate(4);
        return view('Admin.order.list',compact('order'));
    }

    //ajaxStatus
    public function changeStatuws(Request $request){
               $order=Order::select('orders.*','users.name')
               ->leftJoin('users','users.id','orders.user_id')
               ->when(request('key'),function($query){
                   $query->orWhere('users.name','like','%'.request('key').'%')
                           ->orWhere('orders.order_code','like','%'.request('key').'%')
                           ->orWhere('orders.created_at','like','%'.request('key').'%')
                           ->orWhere('orders.total_price','like','%'.request('key').'%');
               })
               ->orderBy('created_at','desc');
               if ($request->orderStatus == null) {
                 $order=$order->get();
               }else{
                $order=$order->orWhere('orders.status',$request->orderStatus)->get();
               }
               return view('Admin.order.list',compact('order'));
    }
    //ajaxChangeStatus
    public function ajaxChangeStatus(Request $request){
        Order::where('id',$request->orderId)->update([
            'status'=>$request->status
        ]);
    }
    //listInfo
    public function listInfo($orderCode){
        $order=Order::where('order_code',$orderCode)->first();
           $orderList=OrderList::select('order_lists.*','users.name as user_name','products.image as product_image','products.name as product_name')
                                ->leftJoin('users','users.id','order_lists.user_id')
                                ->leftJoin('products','products.id','order_lists.product_id')
                                ->where('order_code',$orderCode)->get();
           return view('Admin.order.productList',compact('orderList','order'));
    }
}
