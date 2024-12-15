<header class="header">
    <div class="menu-container">
        <div class="hamburger-menu">
            <input type="checkbox" id="menu-btn" class="menu-checkbox">
            <label for="menu-btn" class="menu-icon">
                <span></span>
                <span></span>
                <span></span>
            </label>

            <ul class="menu-list">
                <li class="close-btn">
                    <label for="menu-btn" class="close-icon">×</label>
                </li>
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
        <h1 class="site-title">Rese</h1>
    </div>
</header>
