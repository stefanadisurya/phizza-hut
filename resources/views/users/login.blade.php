@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-sm-12">
            <div class="card text-white mb-3 mx-auto my-3 mt-5" style="max-width: 50rem;">    
                <div class="card-header bg-danger">Login</div>
                <div class="card-body text-dark">
                    <div class="container">
                       <form class="form-horizontal" action="{{ route('verifyLogin') }}" method="POST">
                            @csrf
                            <div class="form-group row d-flex justify-content-center">
                                <label for="email" class="col-lg-2 col-form-label">Email Address</label>
                                <div class="col-lg-6">
                                  <input type="email" class="form-control" name="email" id="email">
                                </div>
                            </div>
                            <div class="form-group row d-flex justify-content-center">
                                <label for="password" class="col-lg-2 col-form-label">Password</label>
                                <div class="col-lg-6">
                                  <input type="password" class="form-control" name="password" id="password">
                                </div>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="remember_me">
                                <label class="form-check-label" for="remember_me">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection