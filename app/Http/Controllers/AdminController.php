<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //Admin Password Change Page
    public function passwordChangePage(){
        return view('Admin/account/changePassword');
    }
    //Direct Admin Details Page
    public function details(){
        return view('Admin/account/details');
    }
    //Direct Admin Profile Page
    public function edit(){
        return view('Admin.account.edit');
    }
    //Profile Update
    public function update($id,Request $request){
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
        return redirect()->route('admin#details');
    }
    //Admin list
    public function list(){
        $admin=User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                    ->orWhere('email','like','%'.request('key').'%')
                    ->orWhere('gender','like','%'.request('key').'%')
                    ->orWhere('phone','like','%'.request('key').'%')
                    ->orWhere('address','like','%'.request('key').'%');
        })
        ->where('role','admin')->paginate(3);
        $admin->appends(request()->all());
        return view('Admin.account.list',compact('admin'));
    }
    //Admin accout delete
    public function delete(Request $request){
        User::where('id',$request->adminId)->delete();
        return back()->with(['deleteSuccess'=>'Admin Account Delete Successful!']);
    }
    //Admin Change Role
    public function adminChangeRole($id){
        $account=User::where('id',$id)->first();
        return view('Admin.account.changeRole',compact('account'));
    }
    //Change Role
    public function change($id,Request $request){
        $data=$this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }
    //requestUserData
    private function requestUserData($request){
        return[
            'role'=>$request->role,
        ];
    }
    //Change Password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $user=User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue=$user->password;
        $data=[
            'password'=>Hash::make($request->newPassword)
        ];
        if ( Hash::check($request->oldPassword, $dbHashValue)) {
                User::where('id',Auth::user()->id)->update($data);
                Auth::logout();
                // return redirect()->route('auth#loginPage');
        }
        return back()->with(['noMatch'=>'Your oldpassword is wrong. Try Again!']);
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

    private function passwordValidationCheck($request){

        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:10',
            'newPassword'=>'required|min:6|max:10',
            'confirmPassword'=>'required|min:6|same:newPassword',
        ])->validate();

    }
}
