<div id="topHeader" class="topHeader container-fluid bg-dark" style="display:none;" >
    <div class="container bg-dark">
        <div class="pos-f-t">
          <div class="" id="">
          @if(Auth::check())
          <div class="row bg-dark pt-4 pb-4 text-white">
              <!-- start left sec -->
              <div class="col-lg-7 col-md-7 col-sm-12">

                  <ul class="list-unstyled">
                  <li class="media">
                    @if(Auth::user()->avatar=="profile.jpg")
                    <img class="rounded-top img-fluid shadow  border border-primary" src="{{URL::to('storage/profile/'.Auth::user()->image)}}" height="100px" width="100px">
                    @else
                    <img class="rounded-top img-fluid shadow border border-primary" src="{{Auth::user()->avatar}}" height="100px" width="100px">
                    @endif
                    <div class="media-body ml-2">
                      <h5 class="mt-4 mb-1">{{Auth::user()->name}}</h5>
                      <h5 class="mt-0 mb-1">{{Auth::user()->email}}</h5>
                    </div>
                  </li>
                </ul>
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
                        <div id="toggleBtnId">
                          <div class="form-group row">
                              <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->
                              <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                  <input  type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                                  <input  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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
                        </div>
                    </form>
                </div>

                <!-- register ----------------------------------------->
                  <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                    <h3>Register Now</h3>
                    <h6 class="mb-4">Welcome to Our Site. Please register to get amazing features .</h6>
                    <!-- Button trigger modal -->
                      <button id="toggleRegisterBtnId" type="button" class="btn btn-primary">
                        Create An Account
                      </button>

                      <!-- Modal -->
                      <div class="mt-4" id="registerFormId" style="display:none;">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Enter name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="input-group mb-3">
                              <div class="custom-file col-lg-12 col-md-12 col-sm-12 col-12">
                                <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="image"  required>
                                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                              </div>
                            </div>

                            <div class="form-group">
                                <div class="">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                    <button id="registerCancelBtn" type="button" class="btn btn-info">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                      </div>
                  </div>
                <!-- regerter ------------------------------------------>

            </div>
          @endif
          </div>
        </div>
    </div>
</div>

<div id="signinId" class="container-fluid" style="background-color: #38cbcb;">
  <div class="container">
    <nav class="pt-2 pb-2">
      <span class=" navbar-toggler" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        @if(Auth::check())
        <small id="topheaderToggleBtn" style="cursor:pointer;font-size:18px; font-weight:500;" class="text-white">
          @if(Auth::user()->avatar=="profile.jpg")
          <img class="pl-0 rounded-circle border border-white" src="{{URL::to('storage/profile/'.Auth::user()->image)}}" height="30px" width="30px" >
          @else
          <img class="pl-0 rounded-circle border border-white" src="{{Auth::user()->avatar}}" height="30px" width="30px" >
          @endif
           My Profile
         </small>
        @else
        <small id="topheaderToggleBtn" style="cursor:pointer;" class="text-white"><i class="fa fa-user"></i> SIgn in</small>
        @endif
      </span>
    </nav>
  </div>
</div>
