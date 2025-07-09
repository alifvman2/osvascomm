<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .textSize {
            font-size: 0.9rem!important;
        }

        .textColor {
            color: rgba(155, 155, 155, 1);
        }

        .admin-body{
            min-height: 100vh;
            background-color: rgba(248, 248, 248, 1);
        }

    </style>

</head>
    <body class="font-sans antialiased @if(request()->routeIs('Admin.*')) admin-body @endif">
        @if(Auth::check() && Auth::user()->role == 'admin')
            <div class="container-fluid" style="min-height: 100vh;">
                <div class="row">
                    @include('layouts.header')
                    <div class="col-md-2 p-0" style="background-color: white; min-height: 100vh;">
                        @include('layouts.sidebar')
                    </div>
                    <div class="col-md-10 p-4">
                        @yield('content')
                    </div>
                </div>
            </div>
        @else
            <div id="page-wrapper">

                @if (!request()->routeIs(['loginCust', 'login', 'register']))
                    @include('layouts.header')

                <!-- Page Content -->
                <div id="main-content">
                    <div class="container">
                @endif
                @yield('content')


                @if (!request()->routeIs(['loginCust', 'login', 'register']))
                    </div>
                </div>
                @endif

                @if (request()->routeIs('home'))
                    @include('layouts.footer')
                @endif
            </div>
        @endif
    </body>
    
    <!-- jQuery (required for some plugins like older DataTables extensions) -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- Bootstrap Bundle (includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables Core JS -->
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

    <!-- DataTables Bootstrap 5 Integration -->
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>

    @yield('script')

</html>
