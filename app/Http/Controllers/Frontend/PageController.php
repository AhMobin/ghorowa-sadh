<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Portfolio;
use App\Models\SellerSkill;
use App\Models\UserDescription;
use DB;
class PageController extends Controller
{
    public function index(){
        $categories = Category::select('category_name','category_slug','category_thumb')->take(4)->get();
        $sellers = User::select('name','name_uri','avatar')->where('type','seller')->get();
        return view('frontend.pages.index',compact('categories','sellers'));
    }


    public function categories(){
        $categories = Category::select('category_name','category_slug','category_thumb')->get();
        return view('frontend.pages.all_categories',compact('categories'));
    }


    public function categorySellers($category){
        $seller_category = Category::where('category_slug',$category)->first();
        $sellers = DB::table('seller_skills')->join('users','seller_skills.user_id','users.id')->select('seller_skills.category_name','seller_skills.category_slug','users.name','users.name_uri','users.avatar')->where('seller_skills.category_slug',$category)->get();
        return view('frontend.pages.all_sellers',compact('sellers','seller_category'));
    }


    public function userProfile($user){
        $user = User::where('name_uri',$user)->first();
        $portfolios = Portfolio::where('user_id',$user->id)->get();
        $skills = SellerSkill::where('user_id',$user->id)->get();
        $sellerDescs = UserDescription::where('user_id',$user->id)->first();

        return view('frontend.pages.profile.view_profile',compact('user','portfolios','skills','sellerDescs'));
       
    }
}
