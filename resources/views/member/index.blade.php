@extends('layouts.main')

@section('content')
    <div class="container">
        <a href="{{ route('logout') }}" class="btn btn-danger mx-auto my-4 d-flex justify-content-center" style="max-width: 10rem;">
            Member Log out
        </a>
    </div>
@endsection