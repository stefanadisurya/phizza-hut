{{-- Menampilkan halaman detail transaction --}}
@extends('layouts.master')

@section('title', 'Transaction Details — Phizza Hut')

@section('content')

{{-- Validasi apakah halaman ini diakses oleh user dengan role admin atau member --}}
@if(auth()->user()->role=="admin" || auth()->user()->role=="member" )

@forelse ($detailtransactionlist as $transaction)
    <div class="container my-5">
        <div class="row justify-content-start">
            <div class="col-md-12 my-0">
                <div class="card mt-0 mb-0 bg-transparent">
                    <div class="row showcase-left">
                        <div class="col-sm-4 mr-0">
                            <img src="{{ asset('assets/image/' . $transaction->Pizza->image) }}" class="mx-3 my-3" alt="{{ $transaction->Pizza->name }}" style="width: 370px; height: 350px">
                        </div>
                        <div class="col-lg-6 mx-5 my-3">
                            <p class="h1 font-weight-bold">{{ $transaction->Pizza->name }}</p>
                            <p>Rp. {{ $transaction->Pizza->price }}</p>
                            <p>Quantity :  {{ $transaction->Quantity }}</p>
                            <p>Total Price : Rp. {{ ($transaction->Pizza->price)*($transaction->Quantity) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    @empty
        <div class="d-flex justify-content-center my-5">
            <p class="h4 text-muted">No transaction</p>
        </div>

@endforelse

@endif

@endsection