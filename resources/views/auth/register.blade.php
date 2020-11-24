@extends('layouts.master')

@section('title', 'Register — Phizza Hut')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-sm-12">
            <div class="card text-white mb-3 mx-auto my-3 mt-5" style="max-width: 50rem;">    
                <div class="card-header bg-danger">Register</div>
                <div class="card-body text-dark">
                    <div class="container">
                       <form class="form-horizontal" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group row d-flex justify-content-center">
                                <label for="username" class="col-lg-3 col-form-label d-flex justify-content-end">Username:</label>
                                <div class="col-lg-7 d-flex justify-content-start">
                                  <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" id="username" value="{{ old('username') }}" required>
                                </div>
                                @if ($errors->has('username'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('username') }}
                                    </div>
                                @endif
                            </div>

                            <input type="hidden" name="role" value="member">

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
                                <label for="password" class="col-lg-3 col-form-label d-flex justify-content-end">Confirm Password:</label>
                                <div class="col-lg-7 d-flex justify-content-start">
                                  <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation" id="password" required>
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password_confirmation') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <label for="address" class="col-lg-3 col-form-label d-flex justify-content-end">Address:</label>
                                <div class="col-lg-7 d-flex justify-content-start">
                                  <input type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address" value="{{ old('address') }}" required>
                                </div>
                                @if ($errors->has('address'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <label for="phoneNumber" class="col-lg-3 col-form-label d-flex justify-content-end">Phone Number:</label>
                                <div class="col-lg-7 d-flex justify-content-start">
                                  <input type="text" class="form-control {{ $errors->has('phoneNumber') ? 'is-invalid' : '' }}" name="phoneNumber" id="phoneNumber" value="{{ old('phoneNumber') }}" required>
                                </div>
                                @if ($errors->has('phoneNumber'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phoneNumber') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <label for="gender" class="col-lg-3 col-form-label d-flex justify-content-end">Gender:</label>
                                <div class="col-lg-7 d-flex justify-content-start">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" required>
                                        <label class="form-check-label" for="inlineRadio1">Male</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female" required>
                                        <label class="form-check-label" for="inlineRadio2">Female</label>
                                      </div>
                                </div>
                            </div>

                            <div class="form-group row d-flex justify-content-start">
                                <div class="col-lg-6 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Register</button>
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