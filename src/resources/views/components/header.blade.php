<header class="header">
    <div class="hamburger-menu">

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