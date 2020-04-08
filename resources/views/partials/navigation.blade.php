<nav class="navbar navbar-light bg-light" role="navigation">
    
    <ul class="navbar-nav">

        <li class="nav-item" class="mx-auto">
            <figure  >
                <img class=".img-responsive" hspace="18" alt="logo" src="{{URL('/twitter-logo.png')}}">
            </figure>
        </li>

        <li class="nav-item">
            <a class="navbar-brand" href="{{ route( 'tweet.index') }}">
            Home
            </a>
        </li>
        @auth
        <li class="nav-item">
        <a class="navbar-brand" href="{{ route( 'tweet.create') }}">
            Create Post
            </a>
        </li>

        <li class="nav-item">
        <a class="navbar-brand" href="{{ route( 'profiles.create') }}">
            Profile
            </a>
        </li>
        
        <li class="nav-item">
        <a class="navbar-brand" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>

        <form id="logout-form" action="{{ route('logout') }}"       method="POST" style="display: none;">
                {{ csrf_field() }}
        </form>
        </li>
        @endauth
        @guest
        <li class="nav-item">
        <a class="navbar-brand" href="{{ route( 'login') }}">
            Login
            </a>
        </li>

        <li class="nav-item">
        <a class="navbar-brand" href="{{ route( 'register') }}">
            Register
            </a>
        </li>
        @endauth
    </ul>
</nav>