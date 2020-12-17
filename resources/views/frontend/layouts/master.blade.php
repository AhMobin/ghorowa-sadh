<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
</head>
<body>
    
    <header class="header_section">
        <div class="top_header">
            <div class="top_header_left">
                <a href=""><i class="fa fa-facebook"></i></a>
                <a href=""><i class="fa fa-twitter"></i></a>
                <a href=""><i class="fa fa-youtube"></i></a>
            </div>

            <div class="top_header_right">
              @auth
                <a href="{{ route('dashboard') }}">Profile</a>
                  <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              @else
                <a href="">Sign Up</a>
                <a href="">Sign In</a>
              @endauth
            </div>
        </div>

        {{-- <div class="main_nav"> --}}
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="{{ url('/') }}" style="font-size: 30px; margin-left: 20px;">Logo</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Our Categories
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach(App\Models\Category::select('category_name','category_slug')->get() as $category)
                          <a class="dropdown-item" href="{{ 'sellers/'.$category->category_slug }}">{{ $category->category_name }}</a>
                        @endforeach
                      </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                  </ul>

                  <form class="form-inline ml-4 my-2 my-lg-0" style="margin-right: 20px;">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                  </form>
                </div>
              </nav>
        {{-- </div> --}}
    </header>

    @yield('main')


    <footer class="mt-5">
        <div class="footer_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 col-12">
                        <ul>
                            <li><a href="">About Us</a></li>
                            <li><a href="">Contact Us</a></li>
                            <li><a href="">Help Desk</a></li>
                        </ul>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12 col-12">
                        <ul>
                            <li>
                                <form action="" method="POST">
                                    <input type="email" placeholder="enter your email">
                                    <button type="submit" class="btn btn-success">Subscribe Us</button>
                                </form>
                            </li>
                            <li><a href="">Privacy Policy</a></li>
                            <li><a href="">Term & Conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright">
            <p>Copyright &copy; ProjectName. <script>document.write(new Date().getFullYear())</script></p>
        </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css"></script>
</body>
</html>