<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    //contactcreate
    public function contactcreate(Request $request){
        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message
        ];
       Contact::create($data);
       return response()->json($data,200);
    }
}
