<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    //products list
    public function list(){
        $pizzas=Product::select('products.*','categories.name as category_name')
        ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')
        ->paginate(4);
        $pizzas->appends(request()->all());
        return view('Admin.product.pizzalist',compact('pizzas'));
    }
    //Pizza createPage
    public function createPage(){
        $categories=Category::select('id','name')->get();
        return view('Admin.product.create',compact('categories'));
    }

    //Pizza Create
    public function create(Request $request){
        $this->productValidationCheck($request,'create');
       $data= $this->requestProductInfo($request);

        $file=$request->file('pizzaImage');
        $fileName=uniqid().$file->getClientOriginalName();
        $file->storeAs('public',$fileName);
        $data['image']=$fileName;

        Product::create($data);

       return redirect()->route('product#list');

    }
    //Pizza Delete
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list');
    }
    //Pizza Edit
    public function edit($id){
        $pizza=Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('Admin.product.edit',compact('pizza'));
    }
    //Pizza Updatepage
    public function update_page($id){
        $pizza=Product::where('id',$id)->first();
        $category=Category::get();
        return view('Admin.product.update',compact('pizza','category'));
    }
    //update
    public function update(Request $request){
        $this->productValidationCheck($request,'update');
        $data = $this->requestProductInfo($request);
        if ($request->hasFile('pizzaImage')) {
            $oldImageName=Product::where('id',$request->pizzaID)->first();
            $ImageName=$oldImageName->image;
            if ($ImageName != null) {

                Storage::delete('public/'.$ImageName);
                $fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
                $request->file('pizzaImage')->storeAs('public',$fileName);
                $data['image']=$fileName;
            }
            Product::where('id',$request->pizzaID)->update($data);
            return redirect()->route('product#list');
        }

    }



    //requestProductInfo
    private function requestProductInfo($request){
        return [
            'category_id'=>$request->pizzaCategory,
            'name'=>$request->pizzaName,
            'description'=>$request->pizzaDescription,
            'price'=>$request->pizzaPrice,
            'waiting_time'=>$request->pizzaWaitingTime,
        ];
    }

    //productValidationCheck
    private function productValidationCheck($request,$action){
        $validationRules = [
            'pizzaName'=>'required|min:5|unique:products,name,'.$request->pizzaID,
            'pizzaCategory'=>'required',
            'pizzaDescription'=>'required|min:10',
            'pizzaPrice'=>'required',
            'pizzaWaitingTime'=>'required',
        ];
        $validationRules['pizzaImage']=$action == 'create' ? 'required|mimes:jpg,jpeg,png,webp': 'mimes:jpg,jpeg,png,webp';
    Validator::make($request->all(),$validationRules)->validate();
  }
}
