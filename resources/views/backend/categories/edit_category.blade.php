@extends('backend.layout.master')
@section('title','Category')

@section('main')

<div class="container">
    <a href="{{ route('category') }}" class="ml-5 btn btn-sm btn-primary">Back</a>
    <div class="row">
        
        <div class="col-md-6 p-5">
            <h5>Update Category Data</h5><br>

            <form action="{{ url('update/category/'.$category->category_slug) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="categoryName">Category Name:</label>
                    <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}">
                </div>

                <div class="form-group">
                    <label for="categoryName">Category Thumbnail:</label><br>
                    <img src="{{ $category->category_thumb }}" alt="" class="w-25">
                </div>

                <div class="form-group">
                    <label for="categoryName">Update Thumbnail:</label><br>
                    <input type="file" name="category_thumb" class="form-control">
                    <input type="hidden" name="old_category_thumb" value="{{ $category->category_thumb }}">
                </div>

                <button class="btn btn-sm btn-success" type="submit">Update</button>
            </form>
        </div>
    </div>
</div>



@endsection
