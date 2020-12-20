@extends('backend.layout.master')
@section('title','Admin Panel')

@section('main')

<div class="container">
    <div class="row">
        <div class="col-md-12 p-5">
            Welcome to Admin panel! <br><br>
            
            <table class="table table-striped table-bordered table-hover w-50">
                <tr>
                    <th width="40%">User Name:</th>
                    <td>{{ Auth::user()->name }}</td>
                </tr>
                <tr>
                    <th>Email Address:</th>
                    <td>{{ Auth::user()->email }}</td>
                </tr>
                <tr>
                    <th>Phone Number:</th>
                    <td>{{ Auth::user()->phone_number }}</td>
                </tr>
            </table>

            <a href="{{ url('update') }}" class="btn btn-sm btn-purple">Edit Profile</a>
        </div>
    </div>
</div>


@endsection
