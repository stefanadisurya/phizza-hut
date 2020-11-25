@extends('layouts.master')

@section('title', 'Home — Phizza Hut')

@section('content')
<div class="container my-5">
    <h1 class="h1 text-dark">Our freshly made pizza!</h1>
    <hr>
    <div class="container my-2">
        <p class="h2 text-muted">order it now!</p>
        
        @if(auth()->user()->role=="admin")
            <a href="{{ route('add') }}">
                <button class="btn btn-dark text-white mb-4">Add Pizza</button>
            </a>

            <div class="row justify-content-start">
                @foreach ($pizzas as $pizza)
                    <div class="col-md-4 my-3">
                        <div class="card" style="width: 20rem;">
                            <a href="">
                                <img src="{{ asset('/assets/image' . $pizza->image) }}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold text-dark">{{ $pizza->name }}</h5>
                            </a>
                                    <p class="card-text">Rp. {{ $pizza->price }}</p>
                                    <div class="row justify-content-center">
                                    <div class="col-md-6 my-2">
                                        <a href="#" class="btn btn-primary">Update Pizza</a>
                                    </div>

                                    <div class="col-md-6 my-2">
                                        <a href="#" class="btn btn-danger">Delete Pizza</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="container d-flex justify-content-center my-3">
                    {{ $pizzas->links() }}
                </div>
            </div>

        @elseif(auth()->user()->role=="member")
        <div class="row">
            <div class="col-md-2 my-2">
                <p class="text-dark h5">Search Pizza: </p>
            </div>

            <div class="col-md-6">
                <input class="form-control mr-sm-2" type="search" aria-label="Search">
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
            </div>
        </div>

        <div class="row justify-content-start">
            @foreach ($pizzas as $pizza)
                <div class="col-md-4 my-3">
                    <div class="card" style="width: 20rem;">
                        <a href="#">
                            <img src="{{ asset('/assets/image' . $pizza->image) }}" class="card-img-top">
                            <div class="card-body">
                            <h5 class="card-title font-weight-bold text-dark">{{ $pizza->name }}</h5>
                        </a>
                                <p class="card-text">Rp. {{ $pizza->price }}</p>
                            </div>
                    </div>
                </div>
            @endforeach

            <div class="container d-flex justify-content-center my-3">
                {{ $pizzas->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
