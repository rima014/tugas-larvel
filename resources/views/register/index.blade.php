@extends('layouts.app')

@section('content')
    <div class="vh-80">
        <div class="container py-5 h-70">
            <div class="row d-flex justify-content-center align-items-center h-80">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card text-white" style="border-radius: 1rem; background-color: #436fc7;">
                        <div class="card-body p-5">
                            <div class="mt-md-4 pb-5">
                                <div class="text-center">
                                    <h2 class="fw-bold mb-2 text-uppercase ">Register</h2>
                                    <p class="text-white-50 mb-3">Please register your account!</p>
                                </div>
                                <form method="post" action="/register">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="name">{{ __('Name') }}</label>
                                        <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="username">{{ __('Username') }}</label>
                                        <input id="username" type="text" class="form-control form-control-lg @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="email">{{ __('Email') }}</label>
                                        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="password">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="password-confirm">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    {{-- button sign up --}}
                                    <div class="row justify-content-center align-items-center">
                                        <div class="lg-10 text-center">
                                            <button type="submit" class="btn btn-outline-light btn-lg px-5 btn btn-primary">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <div>
                            <p class="mb-0 text-center">Have an account?<a href="{{ route('login.authenticate') }}" class="text-white-50 fw-bold">Login</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

