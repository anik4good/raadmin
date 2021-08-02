<!-- navbar_start -->
<div class="w-100" style="background-color: #fff;">
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #fff;">
        <div class="container">
            <div class="logo">
                <img src="{{asset('assets/frontend')}}/img/homepage/logo_1.png" alt="logo">
                <div class="logo_text">
                    <h2 class="navbar-brand" href="#">AMI<span
                        >FIT</span></h2>
                    <p class="text">YOUR FITNESS MENTOR</p>
                </div>
            </div>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                    data-target="#navbarNav">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" style="text-decoration: underline; color: #FFA300;" href="{{route('frontend.home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">About me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Package</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Testimnonials</a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link text-dark" href="#">Payment</a>
                    </li>
                </ul>
                @guest
                    <button  class="btn btn-outline-warning" style="border-radius: 10px;"><a href="{{route('login')}}">Log in</a></button>
                        &nbsp
                    <button  class="btn btn-outline-warning" style="border-radius: 10px;"><a href="{{route('frontend.form')}}">Sign Up</a></button>
                @else
                    <div class="app-header-right">
                        <div class="header-btn-lg pr-0">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="btn-group">
                                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                               class="p-0 btn">
                                                <img width="42" class="rounded-circle" src="{{ Auth::user()->getFirstMediaUrl('avatar') != null ? Auth::user()->getFirstMediaUrl('avatar') : config('app.placeholder').'160' }}"
                                                     alt="">
                                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true"
                                                 class="dropdown-menu dropdown-menu-right">
                                                <a tabindex="0" class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
{{--                                                <a tabindex="0" class="dropdown-item" href="{{ route('app.profile.index') }}">Profile</a>--}}
{{--                                                <a tabindex="0" class="dropdown-item" href="{{ route('app.profile.password.change') }}">Change Password</a>--}}
                                                <div tabindex="-1" class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{ url('logout') }}">
                                                    <i class="ik ik-power dropdown-icon"></i>
                                                    {{ __('Logout')}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content-left  ml-3 header-user-info">
                                        <div class="widget-heading">
{{--                                            {{ Auth::user()->name }}--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                        <button class="btn btn-outline-warning" style="border-radius: 10px;"><a href="{{route('app.dashboard')}}">Dashboard</a></button>--}}
                @endguest


            </div>

        </div>

    </nav>


</div>

<!-- navbar_end -->
