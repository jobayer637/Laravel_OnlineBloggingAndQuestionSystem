@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
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
                                      <input  type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                      @error('email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>


                              <div class="input-group mb-3">

                                <div class="custom-file col-lg-12 col-md-12 col-sm-12 col-12">
                                  <input type="file"  class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="image"  required>
                                  <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                </div>
                              </div>

                              <div class="form-group">
                                  <label for="password" class="text-md-right">{{ __('Password') }}</label>

                                  <div class="">
                                      <input  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
    </div>
</div>
@endsection
