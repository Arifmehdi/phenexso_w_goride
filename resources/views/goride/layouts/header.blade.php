<!-- ── HEADER ── -->
<header>
    <div class="nav-container">
        <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('goride/assets/go_ride_logo.jpg') }}" alt="GoRide Bangladesh"></a></div>
        <button class="mobile-menu-btn" aria-label="Toggle menu"><i class="fas fa-bars"></i></button>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __('goride.nav.home') }}</a></li>
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">{{ __('goride.nav.about') }}</a></li>
                <li><a href="{{ route('service') }}" class="{{ request()->routeIs('service') ? 'active' : '' }}">{{ __('goride.nav.services') }}</a></li>
                <li><a href="{{ route('fleet') }}" class="{{ request()->routeIs('fleet') ? 'active' : '' }}">{{ __('goride.nav.fleet') }}</a></li>
                <li><a href="{{ route('tours') }}" class="{{ request()->routeIs('tours') ? 'active' : '' }}">{{ __('goride.nav.tours') }}</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">{{ __('goride.nav.contact') }}</a></li>
            </ul>
        </nav>
        <div class="nav-right">
            @if(App::getLocale() == 'en')
                <a href="{{ route('welcome.changeLanguage', ['lang' => 'bn']) }}" class="lang-toggle">বাংলা</a>
            @else
                <a href="{{ route('welcome.changeLanguage', ['lang' => 'en']) }}" class="lang-toggle">English</a>
            @endif
            @if(Auth::check())
                <a href="{{ route('user.dashboard') }}" class="login-btn">{{ __('goride.nav.dashboard') }}</a>
            @else
                <a href="{{ route('login') }}" class="login-btn">{{ __('goride.nav.login') }}</a>
            @endif
        </div>
    </div>
</header>
