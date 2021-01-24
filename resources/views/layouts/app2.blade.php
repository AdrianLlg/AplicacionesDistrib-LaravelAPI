<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        {{-- <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="../assets/img/favicon.png"> --}}
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>
          Now UI Dashboard by Creative Tim
        </title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <!-- CSS Files -->
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{ asset('assets/css/now-ui-dashboard.css?v=1.5.0')}}" rel="stylesheet" />
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    </head>
<body>
    <div id="app">
        <main class="content">
            @yield('content')
        </main>
    </div>
    @yield('script')
</body>
</html>
