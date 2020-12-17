<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Portfolio;
use App\Models\SellerSkill;
use App\Models\UserDescription;

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


    public function userProfile($user){
        $user = User::where('name_uri',$user)->first();
        $portfolios = Portfolio::where('user_id',$user->id)->get();
        $skills = SellerSkill::where('user_id',$user->id)->get();
        $sellerDescs = UserDescription::where('user_id',$user->id)->first();

        return view('frontend.pages.profile.view_profile',compact('user','portfolios','skills','sellerDescs'));
       
    }
}
