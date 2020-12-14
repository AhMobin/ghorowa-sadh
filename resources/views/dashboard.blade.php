@extends('backend.layout.master')
@section('title','Category')

@section('main')

<div class="container">
    <div class="row">
        <div class="col-md-12 p-5">
            Welcome to your panel! <br><br>
            
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
        </div>
    </div>
</div>


@endsection
