@extends('backend.layout.master')
@section('title','Category')

@section('main')

<div class="container">
    <div class="row">
        <button class="btn btn-sm btn-primary ml-5" data-toggle="modal" data-target="#addNewCategoryModel">Add New Category</button>
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
                        <th class="th-sm">#SL</th>
                        <th class="th-sm">Category Name</th>
                        <th class="th-sm">Image</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <th class="th-sm">{{ $loop->iteration }}</th>
                        <th class="th-sm">{{ $category->category_name }}</th>
                        <th class="th-sm"><img src="{{ $category->category_thumb }}" width="100" alt=""></th>
                        <th class="th-sm"><a href="{{ url('category/edit/'.$category->category_slug) }}"><i class="fa fa-edit"></i></a></th>
                        <th class="th-sm"><a href="{{ url('category/remove/'.$category->category_slug) }}"><i class="fa fa-trash"></i></a></th>
                    </tr>
                    @endforeach	
                </tbody>
            </table>
        </div>
    </div>
</div>





<!-- Add New Category Model -->
<div class="modal fade" id="addNewCategoryModel" tabindex="-1" role="dialog" aria-labelledby="addNewCategoryModelLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-full-height modal-top" role="document">
    
    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="addNewCategoryModelLabel">Add New Category</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="categoryName">Category Name</label>
                    <input type="text" name="category_name" value="{{ old('category_name') }}" class="form-control @error('category_name') is-invalid @enderror">
                    @error('category_name')
                        <span class="inavlid-feedback" role="alert">
                            <strong style="color: red">{{ $message }}</strong>
                        </span>
                    @enderror    
                </div>
                <div class="form-group">
                    <label for="categoryThumb">Category Image</label>
                    <input type="file" name="category_thumb" class="form-control @error('category_thumb') is-invalid @enderror">
                    @error('category_thumb')
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
