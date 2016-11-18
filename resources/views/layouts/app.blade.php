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
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed" rel="stylesheet">

    @yield('extra-css')

    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

<nav class="navbar navbar-dark bg-inverse navbar-top">
    <div class="container">
        <a class="navbar-brand mb-0" href="{{(Auth::guest() ? route('/') : route('home'))}}"><span class="roboto brand"><b><i class="fa fa-heart-o"></i> FUND</b></span><span class="roboto-condensed brand">ME</span></a>


        <ul class="nav navbar-nav pull-right">
            @if(Auth::guest())
                <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}"><i class="fa fa-sign-in"></i> Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}"><i class="fa fa-user-plus"></i> Register</a></li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown">Hi, {{Auth::user()->first_name}} <img src="{{action('FileController@getAvatar',Auth::user()->getAvatarURL())}}" class="avatar-nav"></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{route('changepassword')}}"><i class="fa fa-key"></i> {{trans('string.change_password')}}</a>
                        <a class="dropdown-item" href="{{route('changeavatar')}}"><i class="fa fa-camera"></i> {{trans('string.change_avatar')}}</a>

                        @if(!Auth::guest() && Auth::user()->userable_type=='App\Administrator')
                            <a class="dropdown-item" href="{{route('admin')}}"><i class="fa fa-cogs"></i> {{trans('string.admin')}}</a>
                        @endif

                        <a class="dropdown-item" href="{{route('logout')}}"><i class="fa fa-sign-out"></i> {{trans('string.logout')}}</a>
                    </div>
                </li>
            @endif
        </ul>

        <br>

        @if(!Auth::guest())
            <ul class="nav navbar-nav pull-right">
                <li class="nav-item"><a class="nav-link" href="{{route('home')}}"><u>Home</u></a></li>
                @if(Auth::user()->userable_type=='App\Administrator')
                    <li class="nav-item"><a class="nav-link" href="{{route('donations/match')}}"><u>{{trans('string.match')}}</u></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('applications')}}"><u>{{trans_choice('string.application',2)}}</u></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('donations')}}"><u>{{trans_choice('string.donation',2)}}</u></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('donationprofiles')}}"><u>{{trans_choice('string.donation_profile',2)}}</u></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('donors')}}"><u>{{trans_choice('string.donor',2)}}</u></a></li>
                @endif
            </ul>
        @endif

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

<footer class="footer navbar-dark bg-inverse">
    <div class="container text-xs-center">
        <span class="text-muted">Fundme &copy; 2016 All Rights Reserved</span>
    </div>
</footer>

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
