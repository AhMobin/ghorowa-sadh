@extends('frontend.layouts.master')
@section('title','All Categories')
@section('main')


<section class="seller_profile mt-5">
    <h3 class="text-center section_heading">{{ $seller_category->category_name }}</h3>
    <div class="container">
        
        <div class="row">
            @foreach($sellers as $seller)
                <div class="col-md-3 col-lg-3 col-sm-6 col-12">
                    <div class="card" style="width: 230px">
                        <img src="{{ $seller->avatar }}" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">{{ $seller->name }}</h5>
                        <p>Total Tasks On {{ $seller_category->category_name }} : 12</p>
                        <a href="{{ url('profile/'.$seller->name_uri) }}" class="btn btn-primary">view profile</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>


@endsection