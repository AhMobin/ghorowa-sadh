<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Portfolio;
use App\Models\SellerSkill;
use App\Models\UserDescription;
use App\Models\HireSeller;
use DB;
use Auth;
use Crypt;

class PageController extends Controller
{
    public function index(){
        $categories = Category::select('category_name','category_slug','category_thumb')->take(4)->get();
        $sellers = User::select('name','name_uri','avatar')->where('type','seller')->get();
        return view('frontend.pages.index',compact('categories','sellers'));
    }


    public function search(){
        $search = $_GET['search'];
        $searchResult = DB::table('seller_skills')
                        ->join('users','seller_skills.user_id','users.id')
                        ->select('seller_skills.*','users.name','users.name_uri','users.avatar')
                        ->where('category_name','LIKE','%'.$search.'%')
                        ->orWhere('category_slug','LIKE','%'.$search.'%')
                        ->orWhere('users.name','LIKE','%'.$search.'%')
                        ->get();
        
        return view('frontend.pages.search',compact('searchResult','search'));
    }


    public function categories(){
        $categories = Category::select('category_name','category_slug','category_thumb')->get();
        return view('frontend.pages.all_categories',compact('categories'));
    }


    public function categorySellers($category){
        $seller_category = Category::where('category_slug',$category)->first();
        $sellers = DB::table('seller_skills')->join('users','seller_skills.user_id','users.id')->select('seller_skills.category_name','seller_skills.category_slug','seller_skills.user_id','users.name','users.name_uri','users.avatar')->where('seller_skills.category_slug',$category)->get();
        // $countTotalTaskOnCategory = ;
        return view('frontend.pages.all_sellers',compact('sellers','seller_category'));
    }


    public function userProfile($user){
        $user = User::where('name_uri',$user)->first();
        $portfolios = Portfolio::where('user_id',$user->id)->get();
        $skills = SellerSkill::where('user_id',$user->id)->get();
        $sellerDescs = UserDescription::where('user_id',$user->id)->first();

        return view('frontend.pages.profile.view_profile',compact('user','portfolios','skills','sellerDescs'));
       
    }


    public function messageToSeller(){
        return view('frontend.pages.message');
    }


    public function hireASeller(Request $request, $seller){
        $sellerId = User::where('name_uri',$seller)->first();
        $buyerId = Auth::id();
        if(Auth::check()){
            $request->validate([
                'order_description' => 'required',
            ]);
            $hire = HireSeller::create([
                'buyer_id' => $buyerId,
                'seller_id' => $sellerId->id,
                'order_description' => $request->order_description,
            ]);
            session()->flash('hired','Your Request Is Sent To Seller');
            return back();
        }else{
            session()->flash('login-first','Please Login First');
            return back();
        }
    }

    public function approvedBuyerRequest($id){
        $orderId = Crypt::decrypt($id);
        HireSeller::where('id',$orderId)->update(['status' => 'in queue']);
        session()->flash('approved','Approved Order');
        return back();
    }


    public function denyBuyerRequest($id){
        $orderId = Crypt::decrypt($id);
        HireSeller::where('id',$orderId)->update(['status' => 'denied']);
        session()->flash('deny','Orded Denied');
        return back();
    }


    public function orderDeliver($id){
        $orderId = Crypt::decrypt($id);
        HireSeller::where('id',$orderId)->update(['status' => 'delivered']);
        session()->flash('delivered','Orded Delivered');
        return back();
    }


    public function orderCancelBySeller($id){
        $orderId = Crypt::decrypt($id);
        HireSeller::where('id',$orderId)->update(['status' => 'canceled by seller']);
        session()->flash('cancel','Order Canceled');
        return back();
    }


    public function orderCancelByBuyer($id){
        $orderId = Crypt::decrypt($id);
        HireSeller::where('id',$orderId)->update(['status' => 'canceled by buyer']);
        session()->flash('cancel','Order Canceled');
        return back();
    }

    
}
