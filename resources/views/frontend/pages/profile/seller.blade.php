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

                            {{-- <a href="" class="btn btn-success w-75 btn-sm">Contact Me</a> --}}
                            <hr>
                                @if($user->name_uri == Auth::user()->name_uri && $checkSkills > 0)
                                <a href="{{ url('update/profile/'.$user->name_uri) }}" class="btn btn-warning w-75 btn-sm mb-3">Edit Profile</a>
                                @endif
                        </div>
                    </div>

                    <div class="skills_n_desc">
                        <div class="skills">
                            <h6>My Skills :-</h6>
                            @if($checkSkills > 0)
                                <ul style="list-style-type: none;">
                                    @foreach($skills as $skill)
                                        <li>- {{ $skill->category_name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                Please Skills First
                            @endif
                        </div>
                            <hr>

                        <div class="desc">
                            <h6>Description :-</h6>
                            @php
                                $count = App\Models\UserDescription::where('user_id',Auth::id())->count();
                                $desc = App\Models\UserDescription::where('user_id',Auth::id())->first();
                            @endphp
                            
                            @if($count > 0)
                                <p>{{ $desc->user_descriptions }}</p>
                            @else
                                <p>Please Add Your Description from Edit Profile</p>
                            @endif
                        
                        </div>

                    </div>
                </div>

                <div class="col-md-6 col-lg-8 col-sm-12 col-12">
                    <div class="seller_project_gallery">
                        
                        @if($checkSkills > 0)

                        <h2>{{ $user->name }} Portfolio</h2>

                        @if(session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('success') }}                    
                            </div>
                        @endif
                        
                        @if(session()->has('warning'))
                            <div class="alert alert-warning" role="alert">
                                {{ session()->get('warning') }}                    
                            </div>
                        @endif

                        <div class="gallery">
                            <div class="row">
                                
                                
                                @forelse($portfolios as $portfolio)
                                    <div class="col-md-4 col-lg-4 col-sm-12 col-12">
                                        <div class="img">
                                            <a data-toggle="modal" style="cursor: pointer;" data-target="#viewPortfolio{{ $portfolio->id }}">
                                                <img src="{{ $portfolio->task_image }}" alt="" class="img-fluid">
                                            </a>
                                            {{-- <a href=""><img src="{{ $portfolio->task_image }}" alt="" class="img-fluid"></a> --}}
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-md-12 col-lg-12 col-12">
                                        <h6 class="text-center text-primary">Add Add Your First Porfolio</h6>
                                    </div>
                                @endforelse
                                
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#addPortfolio">
                                        Add Portfolio
                                      </button>
                                </div>
                                
                            </div>
                        </div>
                        


                        @else
                            <h2>Add Skills Category</h2>

                            @if(session()->has('warning'))
                                <div class="alert alert-warning" role="alert">
                                    {{ session()->get('warning') }}                    
                                </div>
                            @endif

                            <form action="{{ url('add/skills') }}" method="post">
                                @csrf
                
                                <label for="skillsCategory">Select Your Skill Category:</label><br>
                                @foreach($categories as $category)
                                    <input type="checkbox" name="category_slug[]" value="{{ $category->category_slug }}"> {{ $category->category_name }} &nbsp;
                                @endforeach
                                <br><br>
                                <button type="submit" class="btn btn-primary btn-sm">Add Skill</button>
                            </form>


                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Add Portfolio Modal -->
<div class="modal fade" id="addPortfolio" tabindex="-1" role="dialog" aria-labelledby="addPortfolioTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPortfolioTitle">Add New Portfolio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ url('add/portfolio') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="modal-body">
                <div class="form-group">
                    <select name="category_slug" class="form-control @error('category_slug') is-invalid @enderror">
                        <option selected disabled>Select Skill</option>
                        @foreach(App\Models\SellerSkill::where('user_id',Auth::id())->get() as $skill)
                            <option value="{{ $skill->category_slug }}">{{ $skill->category_name }}</option>
                        @endforeach
                    </select>

                    @error('category_slug')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red">{{ $message }}</strong>
                        </span>
                    @enderror    
                </div>

                <div class="form-group">
                    <label for="taskName">Task Name</label>
                    <input type="text" name="task_name" class="form-control @error('task_name') is-invalid @enderror" value="{{ old('task_name') }}">

                    @error('task_name')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="taskImage">Task Image</label>
                    <input type="file" name="task_image" class="form-control @error('task_image') is-invalid @enderror">

                    @error('task_image')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:red">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Add Task</button>
            </div>

        </form>

      </div>
    </div>
  </div>


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

<form action="" method="POST" enctype="multipart/form-data" style="display:none">
    @csrf
    <input type="file" id="browseClick">
    <button type="submit" id="submitNow"></button>
</form>

<script>
    function browseImage(){
        $('#browseClick').click();
        $('#pressOk').css('display','block');
        $('#pressCancel').css('display','block');
    }

    $('#browseClick').change(function(){
        var reader = new FileReader();
        reader.readAsDataURL(this.files[0]);
        reader.onload = function(event){
            var imgSource = event.target.result;
            alert(imgSource)
            $('#imgPreview').attr("src",imgSource);
        }
    })

</script>
@endsection