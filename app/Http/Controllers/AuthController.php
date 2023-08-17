<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    //Direct loginPage
   public function loginpage(){
    return view('login');
   }
    //Direct registerPage
    public function registerpage(){
        return view('register');
    }
    //Direct Dashbord Page
    public function dashboard(){
        if (Auth::user()->role == 'admin') {
            return redirect()->route('category#list');
        }
        return  redirect()->route('user#home');
    }

}
