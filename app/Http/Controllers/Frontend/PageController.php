<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;

class PageController extends Controller
{
    public function index(){
        $categories = Category::select('category_name','category_slug','category_thumb')->take(12)->get();
        $sellers = User::select('name','name_uri','avatar')->where('type','seller')->get();
        return view('frontend.pages.index',compact('categories'));
    }


    public function categorySellers($category){
        //
    }
}
