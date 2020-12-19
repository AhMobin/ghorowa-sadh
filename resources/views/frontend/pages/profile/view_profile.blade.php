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
                            <hr>
                            @if($user->type == 'seller')   
                            <a href="{{ url('hire') }}" class="btn btn-success w-75 btn-sm mb-3">Hire Me</a>
                            @endif
                        </div>
                    </div>

                    
                    @if($user->type == 'seller')
                    <div class="skills_n_desc">
                        <div class="skills">
                            <h6>My Skills :-</h6>
                            <ul style="list-style-type: none;">
                                @foreach($skills as $skill)
                                    <li>- {{ $skill->category_name }}</li>
                                @endforeach
                            </ul>
                        </div>
                            <hr>

                        <div class="desc">
                            <h6>Description :-</h6>
                            <p>{{ $sellerDescs->user_descriptions }}</p>
                        </div>
                    </div>
                    @endif

                </div>

                
                @if($user->type == 'seller')
                <div class="col-md-6 col-lg-8 col-sm-12 col-12">
                    <div class="seller_project_gallery">
                        <div class="gallery">
                            <div class="row">
                                @foreach($portfolios as $portfolio)
                                    <div class="col-md-4 col-lg-4 col-sm-12 col-12">
                                        <div class="img">
                                            <a data-toggle="modal" style="cursor: pointer;" data-target="#viewPortfolio{{ $portfolio->id }}">
                                                <img src="{{ $portfolio->task_image }}" alt="" class="img-fluid">
                                            </a>
                                            
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>


@foreach($portfolios as $portfolio)
<!-- View Portfolio Modal -->
<div class="modal fade" id="viewPortfolio{{ $portfolio->id }}" tabindex="-1" role="dialog" aria-labelledby="viewPortfolioTitle{{ $portfolio->id }}" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="addPortfolioTitle">{{ $portfolio->task_name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <img src="{{ $portfolio->task_image }}" class="w-100" alt="">
            <hr>
            <h6>{{ $portfolio->user->name }}</h6>
        </div>
    </div>
    </div>
</div>
@endforeach



@endsection