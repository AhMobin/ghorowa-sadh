<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
       $categories = Category::select('category_name','category_slug','category_thumb')->get();
       return view('backend.categories.categories',compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'category_name' => 'required|string|unique:categories',
            'category_thumb' => 'required',
        ]);

        $file = $request->file('category_thumb')->store('public/categories/thumbs');
        $imgPathOne = explode('/',$file)[1];
        $imgPathTwo = explode('/',$file)[2];
        $imgPathThree = explode('/',$file)[3];
        $host = $_SERVER['HTTP_HOST'];
        $fileLocation = "http://".$host."/storage/".$imgPathOne."/".$imgPathTwo."/".$imgPathThree;
        
        $insert = Category::create([
            'category_name'  =>  trim($request->category_name),
            'category_thumb' => $fileLocation,
        ]);

        if($insert){
            session()->flash('success','Category Added Successfully');
            return redirect()->back();
        }else{
            session()->flash('warning','Something Went Wrong!');
            return redirect()->back();
        }
    }
}
