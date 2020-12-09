{{-- Menampilkan Landing Page untuk Guest --}}
@extends('layouts.master')

@section('title', 'Home — Phizza Hut')

@section('content')
<div class="container my-5">
    <h1 class="h1 text-dark">Our freshly made pizza!</h1>
    <hr>
    <div class="container my-2">
        <p class="h2 text-muted">order it now!</p>

        {{-- Form untuk search pizza --}}
        <form method="GET" action=" {{ route('root') }}">
            <div class="row">
                <div class="col-md-2 my-2">
                    <p class="text-dark h5">Search Pizza: </p>
                </div>

                <div class="col-md-6">
                    <input class="form-control mr-sm-2" type="search" name="search" aria-label="Search">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                </div>
            </div>
        </form>

        <div class="row justify-content-start">
            {{-- Menggunakan @forelse agar dapat melakukan validasi jika tidak ada data (@empty) --}}
            @forelse ($pizzas as $pizza)
                <div class="col-md-4 my-3">
                    <div class="card" style="width: 20rem;">
                        <a href="/{{ $pizza->id }}">
                            <img src="{{ asset('assets/image/' . $pizza->image) }}" style="height:250px" class="card-img-top">
                            <div class="card-body">
                            <h5 class="card-title font-weight-bold text-dark">{{ $pizza->name }}</h5>
                        </a>
                                <p class="card-text">Rp. {{ $pizza->price }}</p>
                            </div>
                    </div>
                </div>

                @empty
                    <div class="d-flex justify-content-center my-5">
                        <p class="h4 text-muted">No item in the store</p>
                    </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="container d-flex justify-content-center my-3">
            {{ $pizzas->links() }}
        </div>
    </div>
</div>
@endsection