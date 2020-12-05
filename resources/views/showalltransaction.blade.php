@extends('layouts.master')

@section('title', 'showcart — Phizza Hut')

@section('content')

@if(auth()->user()->role=="admin")

<div class="container my-5">

    <table class="table table-bordered">
        <tbody>
            <?php $count = 1 ?>
            @foreach ($transactionlist as $transaction)
                @if ($count % 2 == 0)
                    <tr>
                        <td  >
                            <a href="/detailtransactionlistforadmin/{{$transaction->id}}" style="color: red">Transaction at {{$transaction->created_at}}
                            <br>
                            User ID : {{$transaction->UserId}}
                            <br>
                            Username : {{$transaction->User->username}}</a>
                        </td>
                    </tr>     
                @else
                    <tr class="bg-danger">
                        <td >
                            <a href="/detailtransactionlistforadmin/{{$transaction->id}}" style="color: white">Transaction at {{$transaction->created_at}}
                            <br>
                            User ID : {{$transaction->UserId}}
                            <br>
                            Username : {{$transaction->User->username}}</a>
                        </td>
                    </tr>    
                @endif
                <?php $count = $count + 1 ?>          
            @endforeach
        </tbody>
    </table>

</div>

@endif

@endsection