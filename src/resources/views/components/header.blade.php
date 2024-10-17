<header class="header">
    <div class="hamburger-menu">
        <!-- <input type="checkbox" id="menu-btn" class="menu-checkbox">
        <div class="menu-popup">
            <label for="menu-btn" class="menu-icon">
                <span class="navicon"></span>
            </label>
            <ul class="menu">
                @guest
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('register') }}">Registration</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endguest

                @auth
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </li>
                    <li><a href="{{ route('mypage') }}">My Page</a></li>
                @endauth
            </ul>
        </div> -->

        <input type="checkbox" id="menu-btn" class="menu-checkbox">
        <div class="menu-popup">
            <label for="menu-btn" class="close-btn">×</label>
                <ul class="menu-list">
                    @guest
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('register') }}">Registration</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                    @else
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                    <li><a href="{{ url('/mypage') }}">Mypage</a></li>
                    @endguest
                    </ul>
        </div>

    </div>
    <h1>Rese</h1>
</header>