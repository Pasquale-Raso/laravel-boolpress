<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        
        {{-- per mettere vue aggiungiamo il css --}}
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="container text-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        {{-- <a href="{{ route('login') }}">Login</a> --}}

                        @if (Route::has('register'))
                            {{-- <a href="{{ route('register') }}">Register</a> --}}
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <div id="root"></div>
        {{-- per mettere vue aggiungiamo il js --}}
        <script src="{{asset('js/front.js')}}"></script>
    </body>
</html>
