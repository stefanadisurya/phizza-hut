@extends('layouts.master')

@section('title', 'View Pizza Details — Phizza Hut')

@section('content')
<div class="container my-5">
    <div class="row justify-content-start">
        <div class="col-md-12 my-3">
            <div class="card border-light mt-5 mb-3">
                <div class="row showcase-left">
                    <div class="col-sm-4 mr-0">
                        <img src="{{ asset('assets/image/' . $pizza->image) }}" class="mx-3 my-3" alt="{{ $pizza->name }}" style="width: 370px; height: 350px">
                    </div>
                    
                    <div class="col-lg-6 mx-5 my-3">
                        <p class="h1 font-weight-bold">{{ $pizza->name }}</p>
                        <p>{{ $pizza->description }}</p>
                        <br><br>
                        <p>Rp. {{ $pizza->price }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection