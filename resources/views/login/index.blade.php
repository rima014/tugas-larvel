@extends('layouts.app')

@section('content')
    <div class="vh-90">
        <div class="container py-5 h-80">
        <div class="row d-flex justify-content-center align-items-center h-80">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card text-white" style="border-radius: 1rem; background-color: #436fc7;">
                    <div class="card-body p-3">
                        <div class="mt-md-4 pb-3">
                            <div class="text-center">
                                <h2 class="fw-bold mb-2 text-uppercase ">Login</h2>
                                <p class="text-white-50 mb-5">Please enter your email and password!</p>
                            </div>

                            <form method="post" action="{{ route("login.index") }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label" for="email">{{ __('Email') }}</label>
                                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                {{-- button login --}}
                                <div class="text-center">
                                    <button class="btn btn-outline-light btn-lg px-5 mb-3 btn btn-primary" type="submit">Login</button>
                                </div>
                            </form>
                        </div>

                        <div>
                            <p class="mb-0 text-center">Don't have an account? <a href="/register" class="text-white-50 fw-bold">Register</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection

