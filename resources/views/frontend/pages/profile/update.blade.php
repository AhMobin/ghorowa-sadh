@extends('frontend.layouts.master')
@section('title','Update Profile')

@section('main')
<style>
    label{font-weight: 600}
</style>

<div class="container mt-5">
    <div class="row">
        
        <div class="col-md-6 col-lg-6 col-12">
            
            <h5 class="mb-5 text-center">Update Your Profile Here...</h5>
            
            @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}                    
                </div>
            @endif

            <form action="{{ url('update/profile') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="userName">Full Name:</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $userValue->name }}">
                    
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red">{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="userEmail">Email Address:</label>
                    <input type="email" class="form-control" value="{{ $userValue->email }}" readonly>
                </div>

                <div class="form-group">
                    <label for="phoneNumber">Phone Number:</label>
                    <input type="text" name="phone_number" class="form-control @error('name') is-invalid @enderror" value="{{ $userValue->phone_number }}">
                    
                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red">{{ $message }}</strong>
                        </span>
                    @enderror

                </div>


                <div class="form-group">
                    <label for="userType">User Type:</label><br>
                    <input type="radio" name="type" class="@error('type') is-invalid @enderror" value="seller" @if($userValue->type == 'seller') checked @endif> Seller &nbsp;
                    <input type="radio" name="type" class="@error('type') is-invalid @enderror" value="buyer" @if($userValue->type == 'buyer') checked @endif> Buyer
                    
                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red">{{ $message }}</strong>
                        </span>
                    @enderror

                </div>


                <div class="form-group">
                    <label for="userAvatar">Avatar:</label><br>
                    <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar">
                    <input type="hidden" name="oldAvatar" value={{ $userValue->avatar }}>
                    
                    @error('avatar')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red">{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <button type="submit" class="btn btn-info">Update</button>

            </form>

            <a href="{{ route('dashboard') }}" class="btn btn-warning mt-5">Back</a>
        </div>


        @if(Auth::user()->type == 'seller')

            <div class="col-md-6 col-lg-6 col-12">
                <h5 class="mb-5 text-center">Update Profile Description...</h5>

                @if(session()->has('description'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('description') }}                    
                    </div>
                @endif

                @php
                    $count = App\Models\UserDescription::where('user_id',$userValue->id)->count();
                    $desc = App\Models\UserDescription::where('user_id',$userValue->id)->first();
                @endphp

                
                @if($count < 1)
                    <form action="{{ url('add/user/description') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="user_descriptions" class="form-control"></textarea>
                        </div>
                        <button class="btn btn-success" type="submit">Add Description</button>
                    </form>
                @else

                    
                    <form action="{{ url('update/user/description') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="user_descriptions" class="form-control">{{ $desc->user_descriptions }}</textarea>
                        </div>
                        <button class="btn btn-success" type="submit">Update Description</button>
                    </form>
                
                @endif
            
            </div>
        @endif    
        
    </div>
    
</div>


@endsection