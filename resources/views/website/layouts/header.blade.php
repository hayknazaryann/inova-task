<header class="header">
    <nav class="site-navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="nav-logo">Notepad</a>
            <ul class="nav-menu">

                @auth
                    <li class="nav-item">
                        <a href="{{ route('applications') }}" class="nav-link">Notepad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                @endauth

            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>

    </nav>
</header>
