@extends('frontend.layouts.master')
@section('title','All Categories')

@section('main')

<section class="category_section mt-5">
    <h3 class="text-center section_heading">Our Categories</h3>
    <div class="container">
        <div class="row">
            
            @foreach($categories as $category)

                <div class="col-md-3 col-lg-3 col-sm-6 col-12">
                    <a href="{{ url('all/sellers/'.$category->category_slug) }}">
                        <div class="card">
                            <img class="card-img-top" src="{{ $category->category_thumb }}" alt="">
                            <div class="card-body">
                            <h5 class="card-text">{{ $category->category_name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            
            @endforeach

        </div>
    </div>
</section>

@endsection