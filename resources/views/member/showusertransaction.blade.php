{{-- Menampilkan halaman Transaction History  --}}
@extends('layouts.master')

@section('title', 'Transaction History — Phizza Hut')

@section('content')

@if(auth()->user()->role=="member")

<div class="container my-5">

    <table class="table table-bordered">
        <tbody>
            <?php $count = 1 ?>
            @forelse ($transactionlist as $transaction)
                @if ($count % 2 == 0)
                    <tr>
                        <td><a href="/detailTransactionList/{{$transaction->id}}" style="color: red" >Transaction at {{$transaction->created_at}}</a></td>
                    </tr>     
                @else
                    <tr class="bg-danger">
                        <td><a href="/detailTransactionList/{{$transaction->id}}" style="color: white">Transaction at {{$transaction->created_at}}</a></td>
                    </tr>    
                @endif
                <?php $count = $count + 1 ?>
                
            @empty
                <div class="d-flex justify-content-center my-5">
                    <p class="h4 text-muted">No transaction</p>
                </div>
            @endforelse
        </tbody>
    </table>

</div>

@endif

@endsection