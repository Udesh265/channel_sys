@extends('layouts.app')
    <!-- START: Main Content-->
    @section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-12">
                <form method="POST" action="{{ route('login') }}" class="row row-eq-height lockscreen mt-5 mb-5">
                    @csrf
                    <div class="lock-image col-12 col-sm-5"><img src="{{asset('dist/images/author.jpg')}}" alt="ncc"></div>
                    <div class="login-form col-12 col-sm-7">
                        <div class="form-group mb-3">
                            <label for="emailaddress">Email | Username</label>
                            <input class="form-control" type="text" name="email" placeholder="Enter your email">
                            @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" name="password"
                                placeholder="Enter your password">
                            @error('password')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="custom-control-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button class="btn btn-primary" type="submit"> Log In </button>
                        </div>
                        <div class="mt-4">For New Member Registration ?  <a href="{{ route('register') }}">Click Register</a>
                        <div class="mt-2">Forgot password? <a href="{{ route('password.request') }}">Reset</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- END: Content-->
    @endsection

