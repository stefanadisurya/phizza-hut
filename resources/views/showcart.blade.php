@extends('layouts.master')

@section('title', 'showcart — Phizza Hut')

@section('content')

    @if(auth()->user()->role=="member")

        @foreach ($list as $cart)
            <div class="container my-5">
                <div class="row justify-content-start">
                    <div class="col-md-12 my-3">
                        <div class="card border-light mt-5 mb-3">
                            <div class="row showcase-left">
                                <div class="col-sm-4 mr-0">
                                    <img src="{{ asset('assets/image/' . $cart->Pizza->image) }}" class="mx-3 my-3" alt="{{ $cart->Pizza->name }}" style="width: 370px; height: 350px">
                                </div>
                                
                                <div class="col-lg-6 mx-5 my-3">
                                    <p class="h1 font-weight-bold">{{ $cart->Pizza->name }}</p>
                
                                    <p>Rp. {{ $cart->Pizza->price }}</p>
                                    
                                    <p>Quantity :  {{ $cart->Quantity }}</p>
                                    <br>
                                    <form method="POST" action="/cartlist/update/{{$cart->id}} ">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="Quantity">Quantity : </label>
                                            <div class="col-md-6">
                                                <input id="Quantity" type="text" class="form-control @error('Quantity') is-invalid @enderror" name="Quantity" value="{{ old('Quantity') }}" required autocomplete="Quantity" autofocus>
                                                @error('Quantity')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>  
                                                   
                                        </div>
                                        <div class="form-group row">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Update Quantity') }}
                                            </button>
                                            
                                        </div>
                                    
                                    </form>

                                    <form action="/cartlist/delete/{{$cart->id}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('Delete From Cart') }}
                                        </button>
                                    </form>
            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        
        @endforeach
        <div class="d-flex justify-content-center" style="text-align: center" >

            <form action="{{ route('checkout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-dark">
                    {{ __('Checkout') }}
                </button>
            </form>

        </div>
        <br>
    @endif



@endsection