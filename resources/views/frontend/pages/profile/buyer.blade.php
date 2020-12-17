@extends('frontend.layouts.master')
@section('title','Seller Profile')

@section('main')


<section class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-12">
            <div class="row">
                <div class="col-md-6 col-lg-4 col-sm-12 col-12">
                    <div class="profile">
                        <div class="profile_top_section">
                            <img src="{{ $user->avatar }}" alt="" id="imgPreview" class="img-fluid">
                            <div>
                                <span id="pressOk" class="btn btn-sm btn-info w-25 float-left" style="display:none">OK</span>
                                <span id="pressCancel" class="btn btn-sm btn-danger w-25 float-right" style="display:none">Cancel</span>
                            </div>
                            
                            
                            <h4>{{ $user->name }}</h4>

                            {{-- <a href="" class="btn btn-success w-75 btn-sm">Contact Me</a> --}}
                            <hr>
                                <a href="{{ url('update/profile/'.$user->name_uri) }}" class="btn btn-warning w-75 btn-sm mb-3">Edit Profile</a>
                        </div>
                    </div>

                </div>

                <div class="col-md-6 col-lg-8 col-sm-12 col-12">
                    
                </div>
            </div>
        </div>
    </div>
</section>



@endsection