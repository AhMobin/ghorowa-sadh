@extends('backend.layout.master')
@section('title','Update')

@section('main')

<div class="container ml-5">
    <div class="row">
        <div class="col-md-6 col-lg-6 col-12">
            
            <h5 class="mb-5 text-center">Update Your Profile Here...</h5>
            
            @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}                    
                </div>
            @endif

            <form action="{{ url('update/admin/profile') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="userName">Full Name:</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}">
                    
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red">{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="userEmail">Email Address:</label>
                    <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                </div>

                <div class="form-group">
                    <label for="phoneNumber">Phone Number:</label>
                    <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ Auth::user()->phone_number }}">
                    
                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red">{{ $message }}</strong>
                        </span>
                    @enderror

                </div>


                


                <div class="form-group">
                    <label for="userAvatar">Avatar:</label><br>
                    <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar">
                    <input type="hidden" name="oldAvatar" value={{ Auth::user()->avatar }}>
                    
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
    </div>
</div>

@endsection