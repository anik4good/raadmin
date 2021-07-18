@extends('layouts.backend.app')
@section('title', 'Profile')
@section('content')


    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Profile')}}</h5>
                            <span>{{ __('lorem ipsum dolor sit amet, consectetur adipisicing elit')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Pages')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Profile')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            @hasrole('SuperAdmin')
                            <img
                                src="{{ Auth::user()->getFirstMediaUrl('avatar') == null ? Auth::user()->getFirstMediaUrl('avatar') : asset('img/super_admin.jpg') }}"
                                class="rounded-circle" width="150"/>
                            @else
                                <img
                                    src="{{ Auth::user()->getFirstMediaUrl('avatar') != null ? Auth::user()->getFirstMediaUrl('avatar') : config('app.placeholder').'160' }} "
                                    class="rounded-circle" width="150"/>
                            @endhasrole

                                <h4 class="card-title mt-10">{{  $profile->user->name }}</h4>
                                <span
                                             class="badge badge-pill badge-primary">{{  $profile->user->get_roles_single() }}</span>
                                {{--                                 <p class="card-subtitle">{{  $profile->occupation }}</p>--}}
                        </div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-body">
                        <small class="text-muted d-block">{{ __('Email address')}} </small>
                        <h6>{{  $profile->user->email }}</h6>
                        <small class="text-muted d-block pt-10">{{ __('Phone')}}</small>
                        <h6>{{  $profile->phone }}</h6>
                        <small class="text-muted d-block pt-10">{{ __('Address')}}</small>
                        <h6>{{  $profile->address }}</h6>
                        {{--                        <div class="map-box">--}}
                        {{--                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d248849.886539092!2d77.49085452149588!3d12.953959988118836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1670c9b44e6d%3A0xf8dfc3e8517e4fe0!2sBengaluru%2C+Karnataka!5e0!3m2!1sen!2sin!4v1542005497600" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>--}}
                        {{--                        </div>--}}
                        <small class="text-muted d-block pt-30">{{ __('Social Profile')}}</small>
                        <br/>
                        <a class="btn btn-icon btn-facebook" href="https://facebook.com/{{$profile->facebook}}"
                           target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-icon btn-twitter" href="https://twitter.com/{{$profile->twitter}}"
                           target="_blank"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-icon btn-instagram" href="https://instagram.com/{{$profile->instagram}}"
                           target="_blank"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">{{ __('Timeline')}}</a>--}}
                        {{--                        </li>--}}
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#last-month"
                               role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('Profile')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month"
                               role="tab" aria-controls="pills-setting" aria-selected="false">{{ __('Settings')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-password-tab" data-toggle="pill" href="#change-password"
                               role="tab" aria-controls="pills-password" aria-selected="false">{{ __('Password')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        {{--                        <div class="tab-pane fade" id="current-month" role="tabpanel"--}}
                        {{--                             aria-labelledby="pills-timeline-tab">--}}
                        {{--                            <div class="card-body">--}}
                        {{--                                <div class="profiletimeline mt-0">--}}
                        {{--                                    <div class="sl-item">--}}
                        {{--                                        <div class="sl-left"><img src="../img/users/1.jpg" alt="user"--}}
                        {{--                                                                  class="rounded-circle"/></div>--}}
                        {{--                                        <div class="sl-right">--}}
                        {{--                                            <div><a href="javascript:void(0)" class="link">John Doe</a> <span--}}
                        {{--                                                    class="sl-date">5 minutes ago</span>--}}
                        {{--                                                <p>assign a new task <a href="javascript:void(0)"> Design weblayout</a>--}}
                        {{--                                                </p>--}}
                        {{--                                                <div class="row">--}}
                        {{--                                                    <div class="col-lg-3 col-md-6 mb-20"><img src="../img/big/img2.jpg"--}}
                        {{--                                                                                              class="img-fluid rounded"/>--}}
                        {{--                                                    </div>--}}
                        {{--                                                    <div class="col-lg-3 col-md-6 mb-20"><img src="../img/big/img3.jpg"--}}
                        {{--                                                                                              class="img-fluid rounded"/>--}}
                        {{--                                                    </div>--}}
                        {{--                                                    <div class="col-lg-3 col-md-6 mb-20"><img src="../img/big/img4.jpg"--}}
                        {{--                                                                                              class="img-fluid rounded"/>--}}
                        {{--                                                    </div>--}}
                        {{--                                                    <div class="col-lg-3 col-md-6 mb-20"><img src="../img/big/img5.jpg"--}}
                        {{--                                                                                              class="img-fluid rounded"/>--}}
                        {{--                                                    </div>--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="like-comm">--}}
                        {{--                                                    <a href="javascript:void(0)" class="link mr-10">2 comment</a>--}}
                        {{--                                                    <a href="javascript:void(0)" class="link mr-10"><i--}}
                        {{--                                                            class="fa fa-heart text-danger"></i> 5 Love</a>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                    <hr>--}}
                        {{--                                    <div class="sl-item">--}}
                        {{--                                        <div class="sl-left"><img src="../img/users/2.jpg" alt="user"--}}
                        {{--                                                                  class="rounded-circle"/></div>--}}
                        {{--                                        <div class="sl-right">--}}
                        {{--                                            <div><a href="javascript:void(0)" class="link">John Doe</a> <span--}}
                        {{--                                                    class="sl-date">5 minutes ago</span>--}}
                        {{--                                                <div class="mt-20 row">--}}
                        {{--                                                    <div class="col-md-3 col-xs-12"><img src="../img/big/img6.jpg"--}}
                        {{--                                                                                         alt="user"--}}
                        {{--                                                                                         class="img-fluid rounded"/>--}}
                        {{--                                                    </div>--}}
                        {{--                                                    <div class="col-md-9 col-xs-12">--}}
                        {{--                                                        <p> {{ __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.')}}</p>--}}
                        {{--                                                        <a href="javascript:void(0)" class="btn btn-success"> Design--}}
                        {{--                                                                                                              weblayout</a>--}}
                        {{--                                                    </div>--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="like-comm mt-20">--}}
                        {{--                                                    <a href="javascript:void(0)" class="link mr-10">2 comment</a>--}}
                        {{--                                                    <a href="javascript:void(0)" class="link mr-10"><i--}}
                        {{--                                                            class="fa fa-heart text-danger"></i> 5 Love</a>--}}
                        {{--                                                </div>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                    <hr>--}}
                        {{--                                    <div class="sl-item">--}}
                        {{--                                        <div class="sl-left"><img src="../img/users/3.jpg" alt="user"--}}
                        {{--                                                                  class="rounded-circle"/></div>--}}
                        {{--                                        <div class="sl-right">--}}
                        {{--                                            <div>--}}
                        {{--                                                <a href="javascript:void(0)" class="link">John Doe</a> <span--}}
                        {{--                                                    class="sl-date">5 minutes ago</span>--}}
                        {{--                                                <p class="mt-10">{{ __(' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper')}} </p>--}}
                        {{--                                            </div>--}}
                        {{--                                            <div class="like-comm mt-20">--}}
                        {{--                                                <a href="javascript:void(0)" class="link mr-10">2 comment</a>--}}
                        {{--                                                <a href="javascript:void(0)" class="link mr-10"><i--}}
                        {{--                                                        class="fa fa-heart text-danger"></i> 5 Love</a>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                    <hr>--}}
                        {{--                                    <div class="sl-item">--}}
                        {{--                                        <div class="sl-left"><img src="../img/users/4.jpg" alt="user"--}}
                        {{--                                                                  class="rounded-circle"/></div>--}}
                        {{--                                        <div class="sl-right">--}}
                        {{--                                            <div><a href="javascript:void(0)" class="link">John Doe</a> <span--}}
                        {{--                                                    class="sl-date">5 minutes ago</span>--}}
                        {{--                                                <blockquote class="mt-10">--}}
                        {{--                                                    {{ __('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt')}}--}}
                        {{--                                                </blockquote>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="tab-pane fade show active" id="last-month" role="tabpanel"
                             aria-labelledby="pills-profile-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-6"><strong>{{ __('Full Name')}}</strong>
                                        <br>
                                        <p class="text-muted">{{  $profile->user->name }}</p>
                                    </div>
                                    <div class="col-md-3 col-6"><strong>{{ __('Mobile')}}</strong>
                                        <br>
                                        <p class="text-muted">{{  $profile->phone }}</p>
                                    </div>
                                    <div class="col-md-3 col-6"><strong>{{ __('Email')}}</strong>
                                        <br>
                                        <p class="text-muted">{{  $profile->user->email }}</p>
                                    </div>
                                    <div class="col-md-3 col-6"><strong>{{ __('Address')}}</strong>
                                        <br>
                                        <p class="text-muted">{{  $profile->address }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3 col-6"><strong>{{ __('City')}}</strong>
                                        <br>
                                        <p class="text-muted">{{  $profile->city }}</p>
                                    </div>
                                    <div class="col-md-3 col-6"><strong>{{ __('Post Code')}}</strong>
                                        <br>
                                        <p class="text-muted">{{  $profile->post_code }}</p>
                                    </div>
                                    <div class="col-md-3 col-6"><strong>{{ __('Country')}}</strong>
                                        <br>
                                        <p class="text-muted">{{  $profile->country }}</p>
                                    </div>
                                    <div class="col-md-3 col-6"><strong>{{ __('State')}}</strong>
                                        <br>
                                        <p class="text-muted">{{  $profile->state }}</p>
                                    </div>
                                </div>
                                <hr>
                                <br>
                                <strong>{{ __('About Me')}}</strong>
                                <p>{{  $profile->about }}</p>
                                {{--                                <h4 class="mt-30">{{ __('Skill Set')}}</h4>--}}
                                {{--                                <hr>--}}
                                {{--                                <h6 class="mt-30">{{ __('Wordpress')}} <span class="pull-right">80%</span></h6>--}}
                                {{--                                <div class="progress progress-sm">--}}
                                {{--                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80"--}}
                                {{--                                         aria-valuemin="0" aria-valuemax="100" style="width:80%;"><span class="sr-only">50% Complete</span>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                                <h6 class="mt-30">{{ __('HTML 5')}} <span class="pull-right">90%</span></h6>--}}
                                {{--                                <div class="progress  progress-sm">--}}
                                {{--                                    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90"--}}
                                {{--                                         aria-valuemin="0" aria-valuemax="100" style="width:90%;"><span class="sr-only">50% Complete</span>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                                <h6 class="mt-30">{{ __('jQuery')}} <span class="pull-right">50%</span></h6>--}}
                                {{--                                <div class="progress  progress-sm">--}}
                                {{--                                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50"--}}
                                {{--                                         aria-valuemin="0" aria-valuemax="100" style="width:50%;"><span class="sr-only">50% Complete</span>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                                <h6 class="mt-30">{{ __('Photoshop')}} <span class="pull-right">70%</span></h6>--}}
                                {{--                                <div class="progress  progress-sm">--}}
                                {{--                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70"--}}
                                {{--                                         aria-valuemin="0" aria-valuemax="100" style="width:70%;"><span class="sr-only">50% Complete</span>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="previous-month" role="tabpanel"
                             aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="example-name">{{ __('Full Name')}}</label>
                                        <input type="text" value="{{$profile->user->name}}" class="form-control"
                                               name="name" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email">{{ __('Email')}}</label>
                                        <input type="email" value="{{$profile->user->email}}" class="form-control"
                                               name="email" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-password">{{ __('Password')}}</label>
                                        <input type="password" value="password" class="form-control"
                                               name="example-password" id="example-password">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-phone">{{ __('Phone No')}}</label>
                                        <input type="text" placeholder="123 456 7890" id="example-phone"
                                               name="example-phone" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-message">{{ __('Message')}}</label>
                                        <textarea name="example-message" name="example-message" rows="5"
                                                  class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-country">{{ __('Select Country')}}</label>
                                        <select name="example-message" id="example-message" class="form-control">
                                            <option>{{ __('London')}}</option>
                                            <option>{{ __('India')}}</option>
                                            <option>{{ __('Usa')}}</option>
                                            <option>{{ __('Canada')}}</option>
                                            <option>{{ __('Thailand')}}</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-success" type="submit">Update Profile</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="change-password" role="tabpanel"
                             aria-labelledby="pills-password-tab">
                            <div class="card-body">
                                <form class="form-horizontal" method="POST"
                                      action="{{route('profile.password.update')}}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="current_password"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>
                                        <div class="col-md-6">
                                            <input id="current_password" type="password"
                                                   class="form-control @error('current_password') is-invalid @enderror"
                                                   name="current_password" required>
                                            @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" required autocomplete="new-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password-confirm"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-arrow-circle-up"></i>
                                                <span>Update</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
