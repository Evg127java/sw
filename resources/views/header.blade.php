<div class="container-fluid">
    <div class="row text-center justify-content-center">
        <div class="col-md-10 px-0 border-bottom">
            <header class="bg-light py-3">
                <div class="row justify-content-start mx-0">
                    <div class="col-2 text-left">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <img src="/images/1200px-Star_wars2.svg.png" alt="logo" width="70" height="35">
                        </a>
                    </div>
                    <div class="col-8">
                        <ul class="nav nav-pills justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::path() === '/' ?  'active bg-secondary ' : '' }}"
                                   href="/">ENTITIES</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::path() === 'create' ?  'active bg-secondary ' : '' }}"
                                   href="/create">CREATE ENTITY</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::path() === 'special' ?  'active bg-secondary ' : '' }}"
                                   href="/homeworld">HOMEWORLD</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
        </div>
    </div>
</div>
