<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    //Direct Category list page
    public function list(){
        $categories=Category::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })
        ->orderBy('id','desc')
        ->paginate(5);
        $categories->appends(request()->all());
        return view('Admin.Category.list',compact('categories'));

    }
    //Direct Category Create Page
    public function createPage(){
        return view('Admin.Category.create');
    }
    //Create Category
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list');
    }
    // Delete Category
    public function delete($id){
       Category::where('id',$id)->delete();
       return back()->with(['deleteSuccess'=>' Delete Successful!']);
    }
    //Edit Page
    public function edit($id){
        $category=Category::where('id',$id)->first();
        return view('Admin.Category.edit',compact('category'));
    }

    //Update Page
    public function update(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$request->categoryID)->update($data);
        return redirect()->route('category#list');
    }

    //Category Validation Check
     private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName'=>'required|min:4|unique:categories,name,'.$request->categoryID
        ])->validate();

     }
     //Request Category Data
     private function requestCategoryData($request){
        return [
            'name'=>$request->categoryName,
        ];
     }
}
