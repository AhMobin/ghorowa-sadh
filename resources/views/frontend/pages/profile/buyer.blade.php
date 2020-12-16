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
                            <img src="images/avatar.png" alt="" class="img-fluid">
                            <h4>Ms Seller</h4>
                            <p>Expert in Clothing</p>
                            <a href="" class="btn btn-success w-75 btn-sm">Contact Me</a>
                            <hr>
                        </div>

                        <div class="profile_desc">
                            <p><i class="fa fa-map-marker"></i> <span>From</span> <strong class="float-right" style="margin-right: 25px;">Dhaka</strong></p>
                            <p><i class="fa fa-map-marker"></i> <span>Member Since</span> <strong class="float-right" style="margin-right: 25px;">January 2021</strong></p>
                            <p><i class="fa fa-map-marker"></i> <span>Hourly Rate</span> <strong class="float-right" style="margin-right: 25px;">BDT 10</strong></p>
                        </div>

                    </div>

                    <div class="skills_n_desc">
                        <div class="skills">
                            <h6>My Skills :-</h6>
                            <ul>
                                <li>Lorem ipsum dolor sit amet.</li>
                                <li>Lorem ipsum dolor sit amet.</li>
                                <li>Lorem ipsum dolor sit amet.</li>
                                <li>Lorem ipsum dolor sit amet.</li>
                                <li>Lorem ipsum dolor sit amet.</li>
                            </ul>
                        </div>
                            <hr>

                        <div class="desc">
                            <h6>Description :-</h6>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Mollitia recusandae rem quos, odit quisquam at reiciendis blanditiis voluptates perspiciatis quas.</p>
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