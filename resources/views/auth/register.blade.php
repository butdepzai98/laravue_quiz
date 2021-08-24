@extends('layouts.app')

@section('content')
    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>

    <div class="col-lg-7">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
            </div>

            <form method="POST" class="user" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" 
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                    placeholder="User Name">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" 
                    name="email" value="{{ old('email') }}" required autocomplete="email"
                    placeholder="Email Address">
                    
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                            id="password" placeholder="Password"
                            name="password" required autocomplete="new-password">
                        
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control form-control-user"
                            id="password-confirm" placeholder="Repeat Password"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-user btn-block">
                    {{ __('Register') }}
                </button>

                <hr>
                <button type="submit" class="btn btn-google btn-user btn-block">
                    <i class="fab fa-google fa-fw"></i> Login with Google
                </button>
                <button type="submit" class="btn btn-facebook btn-user btn-block">
                    <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                </button>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
            </div>
        </div>
    </div>
@endsection
