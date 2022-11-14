<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top p-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="{{URL::asset('/images/name_logo.png')}}" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @forelse ($navItems as $navItem)
                    <li class="nav-item">
                        @if (View::getSection('title')==$navItem['title'])
                        <a class="nav-link active" aria-current="page" href="/{{$navItem['navLink']}}">{{$navItem['item']}}</a>
                        @else
                        <a class="nav-link" href="/{{$navItem['navLink']}}">{{$navItem['item']}}</a>
                        @endif
                    </li>
                    @empty
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    @endforelse
                </ul>
                <h5 class="greetings">
                    @if (date("H") < "12") 
                        Good Morning 
                    @elseif (date("H")>= "12" && date("H") < "17") 
                        Good Afternoon 
                    @elseif (date("H")>= "17" && date("H") < "19") 
                        Good Evening 
                    @elseif (date("H")>= 19)
                        Good Night
                    @endif
                </h5>
            </div>
        </div>
    </nav>