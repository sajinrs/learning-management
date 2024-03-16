<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Learning Management | @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('admin/css/simplebar.css')}}">
    <!-- Fonts CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/feather.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/select2.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/uppy.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/jquery.steps.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/jquery.timepicker.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/quill.snow.css')}}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/daterangepicker.css')}}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/app-light.css')}}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('admin/css/app-dark.css')}}" id="darkTheme" disabled>
    <link rel="stylesheet" href="{{ asset('helper/easy-ajax.css')}}">
    @stack('header-scripts')
    <!-- Scripts -->
</head>

<body class="vertical  light  ">
    <div class="wrapper">
        <nav class="topnav navbar navbar-light">
            <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
                <i class="fe fe-menu navbar-toggler-icon"></i>
            </button>
            <form class="form-inline mr-auto searchform text-muted">
                <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search"
                    placeholder="Type something..." aria-label="Search">
            </form>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                        <i class="fe fe-sun fe-16"></i>
                    </a>
                </li>
                
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="avatar avatar-sm mt-2">
                            <img src="{{ asset('images/avatar.jpg')}}" alt="User" class="avatar-img rounded-circle">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activities</a>
                    </div>
                </li>
            </ul>
        </nav>
        @include('admin/includes/left-menu')
        <main role="main" class="main-content">
            @yield('content')

        </main> <!-- main -->
    </div> <!-- .wrapper -->
    <script src="{{ asset('admin/js/jquery.min.js')}}"></script>
    <script src="{{ asset('admin/js/popper.min.js')}}"></script>
    <script src="{{ asset('admin/js/moment.min.js')}}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('admin/js/simplebar.min.js')}}"></script>
    <script src='{{ asset('admin/js/daterangepicker.js')}}'></script>
    <script src='{{ asset('admin/js/jquery.stickOnScroll.js')}}'></script>
    <script src="{{ asset('admin/js/tinycolor-min.js')}}"></script>
    <script src="{{ asset('admin/js/config.js')}}"></script>
    <script src="{{ asset('admin/js/d3.min.js')}}"></script>
    <script src="{{ asset('admin/js/topojson.min.js')}}"></script>
    
    <script src="{{ asset('admin/js/gauge.min.js')}}"></script>
    <script src="{{ asset('admin/js/jquery.sparkline.min.js')}}"></script>
    <script src='{{ asset('admin/js/jquery.mask.min.js')}}'></script>
    <script src='{{ asset('admin/js/select2.min.js')}}'></script>
    <script src='{{ asset('admin/js/jquery.steps.min.js')}}'></script>
    <script src='{{ asset('admin/js/jquery.validate.min.js')}}'></script>
    <script src='{{ asset('admin/js/jquery.timepicker.js')}}'></script>
    <script src='{{ asset('admin/js/dropzone.min.js')}}'></script>
    <script src='{{ asset('admin/js/uppy.min.js')}}'></script>
    <script src='{{ asset('admin/js/quill.min.js')}}'></script>

    <script src="{{ asset('admin/js/apps.js')}}'"></script>
    @stack('footer-scripts')
    <script src="{{ asset('helper/easy-ajax.js')}}"></script>
    
  </body>
</html>