<div id="loginToggle" class="container-fluid bg-dark" >
    <div class="container bg-dark">
        <div class="pos-f-t">
          <div class="collapse" id="navbarToggleExternalContent">
          @if(Auth::check())
          <div class="row bg-dark pt-4 pb-4 text-white">
              <!-- start left sec -->
              <div class="col-lg-7 col-md-7 col-sm-12">
                @if(Auth::user()->avatar=="profile.jpg")
                <img class="shadow rounded-circle border border-primary" src="http://localhost:8000/storage/profile/{{Auth::user()->image}}" height="100px" width="100px">
                @else
                <img class="shadow rounded-circle border border-primary" src="{{Auth::user()->avatar}}" height="100px" width="100px">
                @endif
                  <span class="ml-2">Welcome  {{Auth::user()->name}}</span>
              </div>
              <!-- end left sec -->

              <!-- start right sec -->
              <div class="col-lg-5 col-md-5 col-sm-12 pl-4 pr-4">
                 <h3 class="text-warning ml-3">quick Links</h3>
                  <div class="row pr-4">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                         <div class="card-body bg-dark text-info">

                            <a class="text-info text-bold" style="text-decoration:none" href="{{ Auth::user()->role_id==1?route('admin.dashboard'):route('author.dashboard') }}">Dashboard</a>  <br>
                             <span>profile Page</span><br>
                             <span>Flowers</span><br>
                             <span>
                               <a class="text-info text-bold" style="text-decoration:none" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                   Logout
                               </a>

                               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                   @csrf
                               </form>
                             </span>
                         </div>
                      </div>
                      <div class="col-lg-7 col-md-7 col-sm-7 col-6">
                          <div class="ml-1 card-body bg-dark text-info">
                             <span>Points</span><br>
                             <span>Posts</span><br>
                             <span>Edit Profile</span><br>
                         </div>
                      </div>
                  </div>
              </div>
              <!-- end right sec -->
          </div>
          @else
            <div class="row bg-dark pt-4 pb-4 text-white">
                <div class="col-lg-7 col-md-7 col-sm-12 col-12">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <!-- <label for="email" class="col-md-4 col-form-label text-md-right"></label> -->

                            <!-- <div class="col-md-6">
                              <h3 class="mb-4">Please Sign in</h3>
                              <a href="{{ url('/login/facebook') }}" class="btn btn-lg btn-primary btn-block">
                              <strong>Login With Facebook</strong>
                              </a>
                            </div>  -->

                            <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                              <h3 class="mb-4">Please Sign in</h3>
                              <a href="{{ url('/login/google') }}" class="btn btn-lg btn-primary btn-block">
                              <strong>Continue With Google</strong>
                              </a>
                            </div>

                        </div>

                        <div class="form-group row">
                            <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->
                            <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->

                            <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>

                        </div>

                        <div class="form-group row ml-1">

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                        </div>
                    </form>
                </div>

                <!-- register ----------------------------------------->
                  <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                    <h3>Register Now</h3>
                    <h6 class="mb-4">Welcome to Our Site. Please register to get amazing features .</h6>
                    <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
                        Create An Account
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                          <div class="modal-content bg-white text-dark">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalScrollableTitle">Register Now</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body w-100">
                              <a href="{{ url('/login/google') }}" class="btn btn-primary mb-4"  name="button">Continue with Google</a>
                              <div class="mt-4">
                                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name" class="text-md-right">{{ __('Name') }}</label>

                                        <div class="">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class=" text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                          <label for="p-image" class="text-md-right">{{ __('Profile Image') }}</label>
                                            <input id="p-image" type="file"  name="image"  required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="text-md-right">{{ __('Password') }}</label>

                                        <div class="">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm" class="text-md-right">{{ __('Confirm Password') }}</label>

                                        <div class="">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="form-group mb-0">
                                        <div class="">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                <!-- regerter ------------------------------------------>

            </div>
          @endif
          </div>
        </div>
    </div>
</div>

<div class="container-fluid" style="background-color: #38cbcb;">
  <div class="container">
    <nav class="pt-2 pb-2">
      <span class=" navbar-toggler" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        @if(Auth::check())
        <small style="cursor:pointer;font-size:18px; font-weight:500;" class="text-white"><i class="fa fa-vcard-o" style="font-size:24px"></i> My Profile</small>
        @else
        <small style="cursor:pointer;" class="text-white"><i class="fa fa-user"></i> SIgn in</small>
        @endif
      </span>
    </nav>
  </div>
</div>
