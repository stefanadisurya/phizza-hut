@extends('layouts.master')

@section('title', 'View All User — Phizza Hut')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-start">
            @forelse ($users as $user)
            <div class="col-md-3 my-3">
                <div class="card">
                    <div class="card-header bg-danger text-white">{{ __('User ID') }}: {{ $user->id }}</div>
                        
                    <div class="card-body">
                        <p class="text-dark">Username: {{ $user->username }}</p>
                        <p class="text-dark">Email: {{ $user->email }}</p>
                        <p class="text-dark">Address: {{ $user->address }}</p>
                        <p class="text-dark">Phone Number: {{ $user->phoneNumber }}</p>
                        <p class="text-dark">Gender: {{ $user->gender }}</p>
                    </div>
                </div>
            </div>

            @empty
                <div class="d-flex justify-content-center my-5">
                    <p class="h4 text-muted">No user</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection