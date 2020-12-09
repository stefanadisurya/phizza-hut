{{-- Menampilkan halaman Edit Pizza --}}
@extends('layouts.master')

@section('title', 'Edit Pizza — Phizza Hut')

@section('content')
<div class="container my-5">
    <div class="row justify-content-start">
        <div class="col-md-12 my-3">
            <div class="card border-light mt-5 mb-3">
                <div class="row showcase-left">
                    <div class="col-sm-3 mr-0">
                        <img src="{{ asset('assets/image/' . $pizza->image) }}" class="mx-3 my-3" alt="{{ $pizza->name }}" style="width: 270px; height: 250px">
                    </div>
                    
                    <div class="col-lg-6 mx-5 my-3">
                        <h1 class="text-dark mb-4">Edit Pizza Details</h1>
                        {{-- Form untuk edit pizza --}}
                        <form method="POST" action="/edit/{{ $pizza->id }}" enctype="multipart/form-data">
                            @csrf
    
                            <div class="form-group row">
                                <label for="name" class="col-md-6 col-form-label text-md-left">{{ __('Pizza Name') }}:</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $pizza->name }}" required autocomplete="name" autofocus>
                                    {{-- Pesan error untuk name --}}
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-6 col-form-label text-md-left">{{ __('Pizza Price') }}:</label>
    
                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $pizza->price }}" required autocomplete="price">
                                    {{-- Pesan error untuk price --}}
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-6 col-form-label text-md-left">{{ __('Pizza Description') }}:</label>
    
                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $pizza->description }}" required autocomplete="description">
                                    {{-- Pesan error untuk description --}}
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-md-6 col-form-label text-md-left">{{ __('Pizza Image') }}:</label>
    
                                <div class="col-md-6">
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" required>
                                    {{-- Pesan error untuk image --}}
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-left">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit Pizza') }}
                                    </button>
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