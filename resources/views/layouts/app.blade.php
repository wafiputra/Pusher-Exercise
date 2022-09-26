<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-notifications.min.css">
    <style>
       #notifDiv {
        z-index:10000;
        display: none;
        background: green;
        font-weight: 450;
        width: 350px;
        position: fixed;
        top: 80%;
        left: 5%;
        color: white;
        padding: 5px 20px;
       }
    </style>
</head>
<body>
    <div id="app">
        <div id="notifDiv"></div>
        <nav class="navbar navbar-expand-sm navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="">{{ env('APP_NAME') }}
                    {{-- {{ Str::ucfirst(Auth::user()->name) }} --}}
                </a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul>
                        <li class="navbar-item px-2">
                            <a href="" class="nav-link active">Dashboard</a>
                        </li>
                    </ul>

                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @foreach ($notification as $key)
                        <li class="nav-item dropdown mr-2" id="{{ $key->id }}">
                            <a href="#" class="nav-link" data-toggle="dropdown">
                                @if ($key->unread)
                                <i class="fa-solid fa-bell">
                                    <span class="badge badge-danger">{{ $key->unread }}</span>
                                </i>
                                @endif
                            </a>
                        </li>
                        @endforeach
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto" style="padding-left: 75%">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        {{-- <script type="text/javascript">
            var notificationsWrapper   = $('.dropdown-notifications');
            var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
            var notificationsCountElem = notificationsToggle.find('i[data-count]');
            var notificationsCount     = parseInt(notificationsCountElem.data('count'));
            var notifications          = notificationsWrapper.find('ul.dropdown-menu');

            if (notificationsCount <= 0) {
                notificationsWrapper.hide();
            }

            // Enable pusher logging - don't include this in production
            // Pusher.logToConsole = true;

            var pusher = new Pusher('cb2c677f4c82c2efbf5d', {
                encrypted: true,
                cluster: 'ap1',
                forceTLS: true
            });

            // Subscribe to the channel we specified in our Laravel Event
            var channel = pusher.subscribe('notif-channel');

             // Bind a function to a Event (the full Laravel class)
            channel.bind('new-event', function(data) {
                var existingNotifications = notifications.html();
                var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
                var newNotificationHtml = `
                    <li class="notification active">
                        <div class="media">
                            <div class="media-left">
                                <div class="media-object">
                                    <img src="https://api.adorable.io/avatars/71/`+avatar+`.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
                                </div>
                            </div>
                            <div class="media-body">
                                <strong class="notification-title">`+data.message+`</strong>
                                <!--p class="notification-desc">Extra description can go here</p-->
                                <div class="notification-meta">
                                    <small class="timestamp">about a minute ago</small>
                                </div>
                            </div>
                        </div>
                    </li>
                `;
                notifications.html(newNotificationHtml + existingNotifications);

                notificationsCount += 1;
                notificationsCountElem.attr('data-count', notificationsCount);
                notificationsWrapper.find('.notif-count').text(notificationsCount);
                notificationsWrapper.show();
            });
        </script> --}}

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

@stack('custom-scripts')
</html>
