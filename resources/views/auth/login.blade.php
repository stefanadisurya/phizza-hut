@extends('layouts.master')

@section('title', 'Login — Phizza Hut')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-sm-12">
            <div class="card text-white mb-3 mx-auto my-3 mt-5" style="max-width: 50rem;">    
                <div class="card-header bg-danger">Login</div>
                <div class="card-body text-dark">
                    <div class="container">
                       <form class="form-horizontal" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group row d-flex justify-content-center">
                                <label for="email" class="col-lg-3 col-form-label d-flex justify-content-end">Email Address:</label>
                                <div class="col-lg-7 d-flex justify-content-start">
                                  <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}" required>
                                </div>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <label for="password" class="col-lg-3 col-form-label d-flex justify-content-end">Password:</label>
                                <div class="col-lg-7 d-flex justify-content-start">
                                  <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" id="password" required>
                                </div>
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <div class="col-lg-3 col-form-label d-flex justify-content-end"></div>
                                <div class="custom-control custom-checkbox col-lg-7 d-flex justify-content-start">
                                  <input type="checkbox" name="remember" class="custom-control-input" id="remember-me">
                                  <label class="custom-control-label" for="remember-me">Remember Me</label>
                                </div>
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <div class="col-lg-4 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                                <div class="col-lg-5">
                                    <p><a href="">Forgot your password?</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection