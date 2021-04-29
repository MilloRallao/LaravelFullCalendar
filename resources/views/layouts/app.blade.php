<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <style type="text/css">
        .btn-label {position: relative;left: -12px;display: inline;padding: 6px 12px;background: rgba(0,0,0,0.15);border-radius: 3px 0 0 3px;}
        .btn-labeled {padding-top: 0;padding-bottom: 0;}
        .btn { margin-bottom:10px; }
        
        .main-section{
            margin: 0 auto;
            padding: 20px;
            margin-top: 100px;
            box-shadow: 0px 0px 20px #c1c1c1;
        }
        #calendar {
          max-width: 1000px;
          margin: 10px auto;
        }
        footer {
            position: relative;
            height: 100px;
            width: 100%;
        }
        .copyright {
            position: absolute;
            width: 100%;
            color: grey;
            line-height: 40px;
            font-size: 0.9em;
            text-align: center;
            bottom:0;
        }
        .fc-ltr .fc-axis {
            text-align: center !important;
        }
        .fc .fc-axis {
            padding: 15px 25px !important;
        }
        .fc-day-grid .fc-row .fc-bg .table-bordered tbody tr .fc-axis span{
            display: none !important;
        }
        .fc-day-grid .fc-row .fc-bg .table-bordered tbody tr .fc-axis:after{
            content: 'Anotaciones' !important;
            margin-left: -20px;
            font-weight: bold;
        }
        .boton {
            text-decoration: none;
        	box-sizing: border-box;
        	margin: auto;
        	border: solid 5px #fff;
        	border-radius: 10%;
        	width: 175px;
        	height: 75px;
        	color: #fff;
        	font: 30px Helvetica;
        	line-height: 65px;
        	text-align: center;
        	background: lightblue;
        	cursor: pointer;
        	user-select: none;
        	transition: all .4s ease-in-out;
        	transform: scale(1);
        	box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
        }
        
        .boton:after {
        	content: "Volver";
        }
        
        .boton:hover {
        	box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        	transform: scale(0.99);
        }
        
        .boton.press {
        	box-shadow: 0 0 5px rgba(0, 0, 0, 0.8);
        	transform: scale(0.98);
        }
        
        .centrar {
        	position: absolute;
        	top: 0;
        	bottom: 23em;
        	left: 0;
        	right: 44em;
        	margin: auto;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Calendario</title>
    
    <!-- Scripts -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" ></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/es.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/locale/es.js"></script>
    <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/bootstrap-switch"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" />
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Calendario
                </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        
                        <!-- Authentication Links -->
                        @guest
                        
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                </li>
                            @endif
                            
                        @else
                            <li class="nav-item dropdown">
                                
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->dni }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    
                                </div>
                            </li>
                        @endguest
                    </ul>
                    
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            @include('sweetalert::alert')`
        </main>
    <footer>
        <p class="copyright">Calendario Educativo - © CIFP Zonzamas {{Carbon\Carbon::now()->format("Y")}}</p>
    </footer>
    </div>
</body>
</html>
