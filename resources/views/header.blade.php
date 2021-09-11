<div class="container-fluid">
    <div class="row text-center justify-content-center">
        <div class="col-md-10 px-0 border-bottom">
            <header class="bg-light py-3">
                <div class="row justify-content-start mx-0">
                    <div class="col-2 text-left">
                        <a class="navbar-brand" href="/">
                            <img src="/img/1200px-Star_wars2.svg.png" alt="logo" width="70" height="35">
                        </a>
                    </div>
                    <div class="col-8">
                        <ul class="nav nav-pills justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::path() === '/' ?  'active bg-secondary ' : '' }}"
                                   href="/">PEOPLE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::path() === 'create' ?  'active bg-secondary ' : '' }}"
                                   href="/create">CREATE PERSON</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::path() === 'special' ?  'active bg-secondary ' : '' }}"
                                   href="/homeworld">HOMEWORLD</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-0 flex-row col-2 d-flex flex-row justify-content-end">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item ml-2">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
            </header>
        </div>
    </div>
</div>
