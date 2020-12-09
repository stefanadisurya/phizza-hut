{{-- Menampilkan halaman Delete Pizza --}}
@extends('layouts.master')

@section('title', 'Delete Pizza — Phizza Hut')

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
                            <br><br>
                            {{-- Form untuk menghapus pizza --}}
                            <form action="{{ $pizza->id }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete Pizza</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection