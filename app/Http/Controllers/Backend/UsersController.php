<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    function __construct(){
        return $this->middleware('auth');
    }

    function index(){
        $users = User::select('id','name','name_uri','email','phone_number','avatar','type')->orderBy('id','asc')->get();
        return view('backend.users.users',compact('users'));
    }
}
