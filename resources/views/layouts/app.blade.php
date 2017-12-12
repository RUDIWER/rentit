<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!--  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  -->
        <meta content="initial-scale=1, shrink-to-fit=no, width=device-width" name="viewport">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RentItAll') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @yield('styles')

    </head>
    <body>
        <div id="app">
            <nav class="navbar fixed-top navbar-expand-lg navbar-dark rw-bg-orange">
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}"> {{ config('app.name', 'RentItAll') }}</a>

                <!-- Collapsed Hamburger -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu items -->
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ml-auto rw-icons">
                    @if (Auth::guest())
                            <li class="nav-item active"><a class="nav-link" href="{{ route('login') }}">{{__('rw_login.login')}}</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{__('rw_login.register')}}</a></li>
                    @else
                <!-- Profiel Picture -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img src="{{ $profile->picture }}" width="30px" height="30px" class="rounded-circle"/>
                            </a>
                        </li>
                <!-- Profile dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->nickname }}&nbsp 
                                @if(count( Auth::user()->notifications))
                                    <span class="badge badge-danger badge-pill">{{count( Auth::user()->notifications)}}</span>
                                @endif
                            </a>
                          
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ url('/my-profile') }}">{{__('rw_login.profile')}}</a> 
                                <a class="dropdown-item" href="{{ url('/my-products') }}">{{__('rw_login.products')}}</a>  
                                <a class="dropdown-item" href="{{ url('/my-messages/inbox') }}">{{__('rw_login.messages')}}&nbsp&nbsp&nbsp
                                    @if(count( Auth::user()->notifications))
                                        <span class="badge badge-danger badge-pill">{{count( Auth::user()->notifications)}}</span></a> 
                                    @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{__('rw_login.logout')}}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                        <!-- Change language dropdown -->
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ (App::getLocale()) }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLang">
                            @foreach (Config::get('app.languages') as $language)
                                @if ($language != App::getLocale())
                                    <a class="dropdown-item" href="{{ route('langroute', $language) }}">{{ ($language) }}</a>
                                @endif
                            @endforeach
                        </div>
                    </li>
                </div>           
            </nav>
            @yield('content')
        </div>
    </body>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('javascript')
</html>
