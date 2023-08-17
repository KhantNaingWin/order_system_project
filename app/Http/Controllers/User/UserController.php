<?php

namespace App\Http\Controllers\User;


use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //User Home
    public function home(){
        $pizza=Product::orderBy('created_at','desc')->get();
        $category=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $history=Order::where('user_id',Auth::user()->id)->get();
        return view('User.main.home',compact('pizza','category','cart','history'));
    }
    //filter
    public function filter($categoryID){
        $pizza=Product::where('category_id',$categoryID)->orderBy('created_at','desc')->get();
        $category=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $history=Order::where('user_id',Auth::user()->id)->get();
        return view('User.main.home',compact('pizza','category','cart','history'));
    }
    //User List Page
    public function userlist(){
        $users=User::where('role','user')->paginate(5);
        return view('Admin.user.list',compact('users'));
    }

//userChangeRole
public function userChangeRole(Request $request){
        User::where('id',$request->userId)->update([
            'role'=>$request->role
        ]);
}


    //Cart List
    public function cartList(){
        $cartList=Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image')
                        ->leftJoin('products','products.id','carts.product_id')
                        ->where('carts.user_id',Auth::user()->id)->get();
       $totalPrice=0;
       foreach ($cartList as $c) {
          $totalPrice+=$c->pizza_price * $c->qty;
       };
        return view('User.main.cart',compact('cartList','totalPrice'));
    }
    //History Cart
    public function history(){
        $order=Order::where('user_id',Auth::user()->id)
                                ->orderBy('created_at','desc')
                                ->paginate(2);
        return view('User.main.history',compact('order'));
    }
    //password change page
    public function userPasswordChange(){
        return view('User.password.change');
    }
    //change password
    public function changepassword(Request $request){
        $this->passwordValidationCheck($request);
        $user=User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue=$user->password;
        $data=[
            'password'=>Hash::make($request->newPassword)
        ];
        if ( Hash::check($request->oldPassword, $dbHashValue)) {
                User::where('id',Auth::user()->id)->update($data);
                return back()->with(["changesuccess"=>"Your password change successful!"]);
        }
        return back()->with(['noMatch'=>'Your oldpassword is wrong. Try Again!']);
    }
    //Account Change
    public function userAccountChange(){
        return view('User.profile.account');
    }
    //changeAccount
    public function changeAccount($id,Request $request){
        $this->accountValidationCheck($request);
        $data=$this->getUserData($request);
        //for image
        if ($request->hasFile('image')) {
            $dbImage=User::where('id',$id)->first();
            $dbImage=$dbImage->image;
                if ($dbImage != null ) {
                    Storage::delete('public/'.$dbImage);
                }
            $fileName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;



        }
        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'Your account is changed successfully!']);
    }
    //Direct Pizza Details
    public function pizzaDetails($id){
        $pizza=Product::where('id',$id)->first();
        $pizzaList=Product::get();
        return view('User.main.detail',compact('pizza','pizzaList'));
    }

    //password validation check
    private function passwordValidationCheck($request){

        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:10',
            'newPassword'=>'required|min:6|max:10',
            'confirmPassword'=>'required|min:6|same:newPassword',
        ])->validate();

    }
    //Get User Data
    public function getUserData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'updated_at'=>Carbon::now(),
        ];
    }
     //Account Validation Check
     private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'image'=>'mimes:png,jpg,jpeg,webp|file',
            'address'=>'required',
            'gender'=>'required',
        ])->validate();
    }
}
