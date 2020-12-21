<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\SellerSkill;
use App\Models\Portfolio;
use App\Models\UserDescription;
use App\Models\hireSeller;
use Auth;
use DB;
use Storage;

class UsersController extends Controller
{
    function __construct(){
        return $this->middleware('auth');
    }

    public function profile(){

        $user = User::where('id',Auth::id())->first();

        if($user->type == 'admin'){
            return view('dashboard',compact('user'));

        }else if($user->type == 'seller'){
            $categories = Category::select('category_name','category_slug')->get();
            $portfolios = Portfolio::where('user_id',$user->id)->get();
            $checkSkills = SellerSkill::where('user_id',Auth::id())->count();
            $orders = HireSeller::where('seller_id',$user->id)->orderBy('id','desc')->paginate(5);
            if($checkSkills>0){
                $skills = SellerSkill::where('user_id',Auth::id())->get();
                return view('frontend.pages.profile.seller',compact('user','checkSkills','categories','skills','portfolios','orders'));
            }else{
                return view('frontend.pages.profile.seller',compact('user','checkSkills','categories','portfolios','orders'));
            }
            
        }else if($user->type == 'buyer'){
            $orders = HireSeller::where('buyer_id',$user->id)->get();
            return view('frontend.pages.profile.buyer',compact('user','orders'));
        }
    }


    public function updateProfile($user){
        if(Auth::user()->name_uri == $user){
            $userValue = User::where('name_uri',$user)->first();
            $categories = Category::select('category_name','category_slug')->get();
            return view('frontend.pages.profile.update',compact('userValue','categories'));
        }else{
            return redirect()->route('dashboard');
        }
    }


    public function updateSuperProfile(){
        return view('backend.admin_update');
    }


    public function profileUpdate(Request $request){
        $host = $_SERVER['HTTP_HOST'];
        if($request->hasFile('avatar')){
            if(Auth::user()->avatar){
                $oldAvatar = $request->oldAvatar;
                $getoldAvatar = explode('/',$oldAvatar);
                $lastgetoldAvatar = 'public/users/avatar/'.end($getoldAvatar);
                Storage::delete($lastgetoldAvatar);
    
                $avatarPath = $request->file('avatar')->store('public/users/avatar');
                $avatarPathOne = explode('/',$avatarPath)[1];
                $avatarPathTwo = explode('/',$avatarPath)[2];
                $avatarPathThree = explode('/',$avatarPath)[3];
    
                $avatarLocation = "http://".$host."/storage/".$avatarPathOne."/".$avatarPathTwo."/".$avatarPathThree;

                User::where('id',Auth::id())->update([
                    'avatar' => $avatarLocation,
                ]);
            
            }else{
                $userImage = $request->file('avatar')->store('public/users/avatar');
                $imgPathOne = explode('/',$userImage)[1];
                $imgPathTwo = explode('/',$userImage)[2];
                $imgPathThree = explode('/',$userImage)[3];
                $avatarLocation = "http://".$host."/storage/".$imgPathOne."/".$imgPathTwo."/".$imgPathThree;
                
                User::where('id',Auth::id())->update([
                    'avatar' => $avatarLocation,
                ]);
            
            }
        }

        $update = User::where('id',Auth::id())->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'type' => $request->type,
        ]);

        session()->flash('success','Successfully Profile Updated');
        return back();
    }


    public function adminProfileUpdate(Request $request){
        $host = $_SERVER['HTTP_HOST'];
        
        if($request->hasFile('avatar')){
            if(Auth::user()->avatar){
                $oldAvatar = $request->oldAvatar;
                $getoldAvatar = explode('/',$oldAvatar);
                $lastgetoldAvatar = 'public/users/avatar/'.end($getoldAvatar);
                Storage::delete($lastgetoldAvatar);
    
                $avatarPath = $request->file('avatar')->store('public/users/avatar');
                $avatarPathOne = explode('/',$avatarPath)[1];
                $avatarPathTwo = explode('/',$avatarPath)[2];
                $avatarPathThree = explode('/',$avatarPath)[3];
    
                $avatarLocation = "http://".$host."/storage/".$avatarPathOne."/".$avatarPathTwo."/".$avatarPathThree;

                User::where('id',Auth::id())->update([
                    'avatar' => $avatarLocation,
                ]);
            
            }else{
                $userImage = $request->file('avatar')->store('public/users/avatar');
                $imgPathOne = explode('/',$userImage)[1];
                $imgPathTwo = explode('/',$userImage)[2];
                $imgPathThree = explode('/',$userImage)[3];
                $avatarLocation = "http://".$host."/storage/".$imgPathOne."/".$imgPathTwo."/".$imgPathThree;
                
                User::where('id',Auth::id())->update([
                    'avatar' => $avatarLocation,
                ]);
            
            }
        }

        $update = User::where('id',Auth::id())->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
        ]);

        session()->flash('success','Successfully Profile Updated');
        return back();
    }


    public function addDescription(Request $request){
        UserDescription::create([
            'user_id' => Auth::id(),
            'user_descriptions' => $request->user_descriptions
        ]);

        session()->flash('description','Successfully Description Inserted');
        return back();
    }

    public function updateDescription(Request $request){
        UserDescription::where('user_id',Auth::id())->update([
            'user_descriptions' => $request->user_descriptions
        ]);

        session()->flash('description','Successfully Description Updated');
        return back();
    }

    public function addSkills(Request $request){
        $skills = $request->category_slug;

        // if(count($skills) >= 6){
        if(is_countable($skills) && count($skills) > 6){
            session()->flash('warning','Cannot Add More Than Six Skills Category');
            return back();
        }else{
            foreach($skills as $skill){
                $category = Category::where('category_slug',$skill)->first();
                SellerSkill::create([
                    'user_id' => Auth::id(),
                    'category_slug' => $skill,
                    'category_name' => $category->category_name,
                ]);
            }
        }
        session()->flash('success','Successfully Skill Category Added');
        return redirect()->back();
    }


    public function addPortfolio(Request $request){
        $request->validate([
            'category_slug' => 'required',
            'task_name' => 'required|unique:portfolios',
            'task_image' => 'required|mimes:JPG,jpg,PNG,png,jpeg,JPEG,webp,WEBP',
        ]);

        $taskImage = $request->file('task_image')->store('public/sellers/portfolios');
        $imgPathOne = explode('/',$taskImage)[1];
        $imgPathTwo = explode('/',$taskImage)[2];
        $imgPathThree = explode('/',$taskImage)[3];
        $host = $_SERVER['HTTP_HOST'];
        $taskImageLocation = "http://".$host."/storage/".$imgPathOne."/".$imgPathTwo."/".$imgPathThree;

        $insert = Portfolio::create([
            'user_id' => Auth::id(),
            'category_slug' => $request->category_slug,
            'task_name' => $request->task_name,
            'task_image' => $taskImageLocation,
        ]);

        if($insert){
            session()->flash('success','Successfully Portfolio Added');
            return redirect()->back();
        }else{
            session()->flash('warning','Something Went Wrong');
            return redirect()->back();
        }
    }

    function allUsers(){
        $users = User::select('id','name','name_uri','email','phone_number','avatar','type')->orderBy('id','asc')->get();
        return view('backend.users.users',compact('users'));
    }
}
