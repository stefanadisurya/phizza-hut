<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>404 Error — Page Not Found</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .btn {
            border: 1px solid rgb(95, 116, 156);
            background-color: transparent;
            color: rgb(95, 116, 156);
            padding: 5px 50px;
            font-size: 16px;
            cursor: pointer;
        }

        .custom:hover {
            background-color: rgb(95, 116, 156);
            color: white;
        }
    </style>
</head>
<body style="background-color: background-color: rgb(213, 233, 246); color: rgb(95, 116, 156);">
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <img class="mx-auto d-block" src="{{ asset('/assets/image/error.png') }}" alt="" style="height: 300px; width: 300px;">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p class="h1 font-weight-bold text-center mt-5">Oops!</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p class="text-center" style="font-size: 18px;">The page you are looking for might be removed<br>or is temporarily unavailable.</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <a href="{{ route('root') }}" class="btn custom">
                    Go Back
                </a>
                
            </div>
        </div>
    </div>
</body>
</html>