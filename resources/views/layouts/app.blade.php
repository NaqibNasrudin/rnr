
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>R&R | Profile</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">
</head>
    <body>
        <div class="topbar" id="topbar">
            <div class="logo">
                {{-- <h1><a href="">LOGO</a></h1> --}}
                <a href="/"><img src="{{asset('img/rnr_logo.png')}}" alt=""></a>
            </div>
            <div class="nav">
                <ul>
                    <li><a href="/">Home</a></li>
                    {{-- <li><a href="/Book">Book</a></li> --}}
                    <li><a href="/Contact-Us">Contact Us</a></li>
                </ul>
            </div>
            <div class="login">
                <div class="opt">
                    {{-- @if (Route::has('login'))
                        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                            @auth
                                <a href="{{ url('/Profile') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Profile</a>

                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif --}}
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

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>

                        @endguest

                </div>
            </div>
        </div>

        <div class="top">
            <img src="{{asset('img/up-arrow.png')}}" alt="" onclick="topFunction()" id="top-btn">
        </div>

        <div class="container">
            @yield('content')
        </div>

        <script>
            let topbar = document.getElementById('topbar');

            window.addEventListener('scroll', function(){
                let value = window.scrollY;
                topbar.style.bottom = value * 0.5 + 'px';
            })
        </script>

        <script>
            // Get the button:
            let mybutton = document.getElementById("top-btn");

            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            }

        </script>
    </body>
</html>
