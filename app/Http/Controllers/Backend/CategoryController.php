<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Storage;

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


    public function editCategory($slug){
        $category = Category::where('category_slug',$slug)->first();
        return view('backend.categories.edit_category',compact('category'));
    }


    public function updateCategory(Request $request, $slug){
        if($request->hasFile('category_thumb')){
            $oldThumb = $request->old_category_thumb;
            $getoldThumb = explode('/',$oldThumb);
            $lastgetoldThumb = 'public/categories/thumbs/'.end($getoldThumb);
            Storage::delete($lastgetoldThumb);

            $updateCategoryThumbPath = $request->file('category_thumb')->store('public/categories/thumbs');
            $updateCategoryThumbPathOne = explode('/',$updateCategoryThumbPath)[1];
            $updateCategoryThumbPathTwo = explode('/',$updateCategoryThumbPath)[2];
            $updateCategoryThumbPathThree = explode('/',$updateCategoryThumbPath)[3];
            $host = $_SERVER['HTTP_HOST'];
            $categoryThumbLocation = "http://".$host."/storage/".$updateCategoryThumbPathOne."/".$updateCategoryThumbPathTwo."/".$updateCategoryThumbPathThree;


            Category::where('category_slug',$slug)->update([
                'category_name' => $request->category_name,
                'category_thumb' => $categoryThumbLocation,
            ]);

            session()->flash('update_category','Category Update Successful');
            return redirect()->route('category');

        }else{
            Category::where('category_slug',$slug)->update([
                'category_name' => $request->category_name,
            ]);

            session()->flash('update_category','Category Update Successful');
            return redirect()->route('category');
        }
    }


    public function removeCategory($slug){
        $category = Category::where('category_slug',$slug)->first();
        $categoryThumb = explode('/',$category->category_thumb);
        $categoryThumbLocation = 'public/categories/thumbs/'.end($categoryThumb);
        Storage::delete($categoryThumbLocation);
        Category::where('category_slug',$slug)->delete();
        
        session()->flash('update_removed','Category Removed');
        return back();
    }
}
