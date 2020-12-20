@extends('frontend.layouts.master')
@section('title','Home')

@section('main')

<div class="banner_section">
    <div class="banner_content">
        <h1>Lorem ipsum dolor sit amet.</h1>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cum necessitatibus non soluta sit quo veniam explicabo voluptatum, molestias dicta delectus quas minus ipsum dolor dignissimos.</p>
    </div>
</div>


<section class="seller_profile mt-5">
    <h3 class="text-center section_heading">Sellers</h3>
    
    <div class="container">
        <div class="row">
            
          @foreach($sellers as $seller)
        
          <div class="col-md-3 col-lg-3 col-sm-6 col-12">
              <div class="card" style="width: 230px">
                <img src="{{ $seller->avatar }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $seller->name }}</h5>
                  <a href="{{ url('profile/'.$seller->name_uri) }}" class="btn-sm btn btn-primary">view profile</a>
                </div>
              </div>
          </div>
          @endforeach


        </div>
    </div>

</section>


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

        <a href="{{ route('all.category') }}" class="all_cat_btn btn btn-danger">View All Category</a>
    </div>
</section>

@endsection

