<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('admin/css/simplebar.css')}}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/app-light.css')}}" id="lightTheme">
</head>
<body class="light ">
    <div class="wrapper vh-100">
        <div class="row align-items-center h-100">
        @yield('content')
            
        </div>
    </div>  

<script src="{{ asset('admin/js/jquery.min.js')}}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js')}}"></script>
</body>

</html>
