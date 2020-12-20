@extends('frontend.layouts.master')
@section('title','Search Result')
@section('main')


<section class="seller_profile mt-5">
    <h3 class="text-center section_heading">Search result for "{{ $search }}"</h3>
    <div class="container">
        
        <div class="row">
            @forelse($searchResult as $result)
                <div class="col-md-3 col-lg-3 col-sm-6 col-12">
                    <div class="card" style="width: 230px">
                        <img src="{{ $result->avatar }}" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">{{ $result->name }}</h5>
                        
                        <a href="{{ url('profile/'.$result->name_uri) }}" class="btn btn-primary">view profile</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 mt-5">
                    <h3 style="color: red">Did not match with any category like "{{ $search }}"</h3>
                </div>
            @endforelse

        </div>
    </div>
</section>


@endsection