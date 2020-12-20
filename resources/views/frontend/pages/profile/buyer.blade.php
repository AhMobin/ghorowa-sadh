@extends('frontend.layouts.master')
@section('title','Buyer Profile')

@section('main')


<section class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-12">
            <div class="row">
                <div class="col-md-6 col-lg-4 col-sm-12 col-12">
                    <div class="profile">
                        <div class="profile_top_section">
                            <img src="{{ $user->avatar }}" alt="" id="imgPreview" class="img-fluid">
                            
                            <h4>{{ $user->name }}</h4>

                            {{-- <a href="" class="btn btn-success w-75 btn-sm">Contact Me</a> --}}
                            <hr>
                                <a href="{{ url('update/profile/'.$user->name_uri) }}" class="btn btn-warning w-75 btn-sm mb-3">Edit Profile</a>
                        </div>
                    </div>

                </div>

                <div class="col-md-6 col-lg-8 col-sm-12 col-12">
                    <h4>Order List</h4><br>
                        <div class="seller_project_gallery">
                            <table class="table table-bordered text-center">
                                <tr>
                                    <th>Seller Name</th>
                                    <th>Contact</th>
                                    <th>Order Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
    
                                @forelse($orders as $order)
                                @if($order->status == 'requested')
                                    <tr style="background: #62929a; color: #fff">
                                        <td><a href="{{ url('profile/'.$order->seller->name_uri) }}" style="color: #fff">{{ $order->buyer->name }}</a></td>
                                        <td class="text-capitalize">{{ $order->seller->phone_number }}</td>
                                        <td class="text-capitalize">{{ $order->order_description }}</td>
                                        <td class="text-capitalize">{{ $order->status }}</td>
                                        <td>
                                            <a href="{{ url('cancel/by/buyer/'.Crypt::encrypt($order->id)) }}" style="color: #fff; margin-left: 10px"><i class="fa fa-thumbs-down" title="cancel order"></i></a>
                                        </td>
                                    </tr>

                                    @elseif($order->status == 'in queue')
                                    <tr style="background: #0d8abc; color: #fff">
                                        <td><a href="" style="color:#fff">{{ $order->buyer->name }}</a></td>
                                        <td class="text-capitalize">{{ $order->buyer->phone_number }}</td>
                                        <td class="text-capitalize">{{ $order->order_description }}</td>
                                        <td class="text-capitalize">{{ $order->status }}</td>
                                        <td>
                                            <span> -- </span>
                                        </td>
                                    </tr>

                                    @elseif($order->status == 'delivered')
                                    <tr style="background: #0da574; color: #fff">
                                        <td><a href="" style="color: #fff">{{ $order->buyer->name }}</a></td>
                                        <td class="text-capitalize">{{ $order->buyer->phone_number }}</td>
                                        <td class="text-capitalize">{{ $order->order_description }}</td>
                                        <td class="text-capitalize">{{ $order->status }}</td>
                                        <td>
                                            <span> -- </span>
                                        </td>
                                    </tr>
                                    @elseif($order->status == 'canceled by seller' || $order->status == 'canceled by buyer')
                                    <tr style="background: #f23557; color: #fff">
                                        <td><a href="" style="color: #fff">{{ $order->buyer->name }}</a></td>
                                        <td class="text-capitalize">{{ $order->buyer->phone_number }}</td>
                                        <td class="text-capitalize">{{ $order->order_description }}</td>
                                        <td class="text-capitalize">{{ $order->status }}</td>
                                        <td>
                                            <span> -- </span>
                                        </td>
                                    </tr>
                                    @elseif($order->status == 'denied')
                                    <tr style="background: #f23557; color: #fff">
                                        <td><a href="" style="color: #fff">{{ $order->buyer->name }}</a></td>
                                        <td class="text-capitalize">{{ $order->buyer->phone_number }}</td>
                                        <td class="text-capitalize">{{ $order->order_description }}</td>
                                        <td class="text-capitalize">{{ $order->status }}</td>
                                        <td>
                                            <span> -- </span>
                                        </td>
                                    </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="2">You Didn't Hire Any Seller Yet</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection