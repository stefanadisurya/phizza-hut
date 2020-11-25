@extends('layouts.master')

@section('title', 'Phizza Hut')

@section('content')
<div class="container my-5">
    <h1 class="h1 text-dark">Our freshly made pizza!</h1>
    <hr>
    <div class="container my-2">
        <p class="h2 text-muted">order it now!</p>

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
        </div>

        <div class="container d-flex justify-content-center my-3">
            {{ $pizzas->links() }}
        </div>
    </div>
</div>
@endsection