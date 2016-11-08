<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>@yield('title') | Fundme</title>

    <link rel="icon" href="{{asset('public/favicon.ico')}}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/tether.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/fa/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/fundme.css')}}">

    @yield('extra-css')

    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<nav class="navbar navbar-fixed-top navbar-dark bg-inverse">
    <div class="container">

        @if(Auth::guest())
            <a class="navbar-brand mb-0" href="{{route('/')}}">Fundme</a>
        @else
            <a class="navbar-brand mb-0" href="{{route('home')}}">Fundme</a>
        @endif

        <div class="float-xs-right">
            <ul class="nav navbar-nav">
                @if(Auth::guest())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}"><i class="fa fa-sign-in"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register') }}"><i class="fa fa-user-plus"></i> Register</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown">Hi, {{Auth::user()->first_name }}</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('logout')}}"><i class="fa fa-sign-out"></i> {{trans('string.logout')}}</a>
                        </div>
                    </li>
                @endif
            </ul>
        </div>

    </div>
</nav>

@if(Session::has('flash_info'))
    <div class="container notice-container">
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            {{Session::get('flash_info')}}
        </div>
    </div>
@endif

@if(Session::has('flash_success'))
    <div class="container notice-container">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            {{Session::get('flash_success')}}
        </div>
    </div>
@endif

@if(Session::has('flash_danger'))
    <div class="container notice-container">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            {{Session::get('flash_danger')}}
        </div>
    </div>
@endif

@yield('content')

<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<script src="{{asset('public/js/tether.min.js')}}"></script>
<script src="{{asset('public/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/js/tablesort.min.js')}}"></script>
@yield('extra-js')

<script>
    if (document.getElementById('main-table') != null) {
    new Tablesort(document.getElementById('main-table'));
    }
</script>

</body>
</html>
