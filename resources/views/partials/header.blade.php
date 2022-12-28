    {{-- <nav class="navbar navbar-expand-md navbar-dark fixed-top p-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="{{ URL::asset('/images/name_logo.png') }}"
                    alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @forelse ($navItems as $navItem)
                        <li class="nav-item">
                            @if (View::getSection('title') == $navItem['title'])
                                <a class="nav-link active" aria-current="page"
                                    href="/{{ $navItem['navLink'] }}">{{ $navItem['item'] }}</a>
                            @else
                                <a class="nav-link" href="/{{ $navItem['navLink'] }}">{{ $navItem['item'] }}</a>
                            @endif
                        </li>
                    @empty
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                    @endforelse
                </ul>
                <h5 class="greetings">
                    @if (date('H') < '12')
                        Good Morning
                    @elseif (date('H') >= '12' && date('H') < '17')
                        Good Afternoon
                    @elseif (date('H') >= '17' && date('H') < '19')
                        Good Evening
                    @elseif (date('H') >= 19)
                        Good Night
                    @endif
                </h5>
            </div>
        </div>
    </nav> --}}

    <nav class="navbar navbar-expand-md navbar-dark fixed-top p-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><img src="{{ URL::asset('/images/logo.png') }}" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                {{-- <h1>hi</h1> --}}
                {{-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @forelse ($navItems as $navItem)
                        <li class="nav-item">
                            @if (View::getSection('title') == $navItem['title'])
                                <a class="nav-link active" aria-current="page"
                                    href="/{{ $navItem['navLink'] }}">{{ $navItem['item'] }}</a>
                            @else
                                <a class="nav-link" href="/{{ $navItem['navLink'] }}">{{ $navItem['item'] }}</a>
                            @endif
                        </li>
                    @empty
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                    @endforelse
                </ul> --}}
                {{-- <h5 class="greetings">
                    @if (date('H') < '12')
                        Good Morning
                    @elseif (date('H') >= '12' && date('H') < '17')
                        Good Afternoon
                    @elseif (date('H') >= '17' && date('H') < '19')
                        Good Evening
                    @elseif (date('H') >= 19)
                        Good Night
                    @endif
                </h5> --}}
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-end w-100">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="/">Home</a>
                    </li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link navBtnGuestLogin" href="{{ route('login') }}">
                                    Login
                                </a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link navBtnGuestRegister" href="{{ route('register') }}">
                                    Register
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="/display/book">Books</a>
                        </li>

                        @if (Auth::user()->isAdmin == 0)
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="/cart">Cart</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="/transactions">Transaction</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="/loans">Loans</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="/adminTransactions">Transaction</a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    @endguest
                </ul>
            </div>
        </div>
    </nav>
