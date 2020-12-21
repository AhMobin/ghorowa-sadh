@extends('backend.layout.master')
@section('title','All Users')

@section('main')

<div class="container">
    <div class="row">
        <button class="btn btn-sm btn-primary ml-5" data-toggle="modal" data-target="#addNewUserModel">Add New User</button>
        <div class="col-md-12 p-5">
            <h5>List of All Categories</h5><br>

            @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>

            @elseif(session()->has('warning'))  
                <div class="alert alert-warning" role="alert">
                    {{ session()->get('warning') }}
                </div>
            @endif

            <table class="table table-striped table-sm text-center table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="5" class="th-sm">#SL</th>
                        <th class="th-sm">User Name</th>
                        <th class="th-sm">Phone Number</th>
                        <th class="th-sm">Email Address</th>
                        <th class="th-sm">User Type</th>
                        <th class="th-sm">Avatar</th>
                        {{-- <th class="th-sm">Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th class="th-sm">{{ $loop->iteration }}</th>
                        <th class="th-sm">{{ $user->name }}</th>
                        <th class="th-sm">{{ $user->phone_number }}</th>
                        <th class="th-sm">{{ $user->email }}</th>
                        <th class="th-sm">{{ $user->type }}</th>
                        <th class="th-sm"><img src="{{ $user->avatar }}" width="75" alt=""></th>
                        {{-- <th class="th-sm"> --}}
                            {{-- <a href=""><i class="fa fa-eye"></i></a> --}}
                            {{-- <a href=""><i class="fa fa-trash ml-5"></i></a> --}}
                        {{-- </th> --}}
                    </tr>
                    @endforeach	
                </tbody>
            </table>
        </div>
    </div>
</div>





<!-- Add New User Model -->
<div class="modal fade" id="addNewUserModel" tabindex="-1" role="dialog" aria-labelledby="addNewUserModelLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-full-height modal-top" role="document">
    
    <form action="" method="post">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="addNewUserModelLabel">Add New User</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="userName">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <span class="inavlid-feedback" role="alert">
                            <strong style="color: red">{{ $message }}</strong>
                        </span>
                    @enderror    
                </div>
                
            </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </div>
        
    </form>

  </div>
</div>

@endsection