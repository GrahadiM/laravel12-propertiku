<header class="header" id="header">
    <nav class="nav container">
        <a href="{{ route('home') }}" class="nav__logo">
            <img width="100" style="height: 50px; object-fit: cover" src="{{ asset('frontend/assets/images/alhamraresto-logo.png') }}" alt="logo" />
        </a>

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="{{ route('home') }}" class="nav__link {{ request()->is('/') ? ' active-link' : '' }}">
                        <i class="bx bx-home nav__icon"></i>
                        <span class="nav__name">Beranda</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a href="{{ route('property') }}" class="nav__link {{ request()->is('properti*') ? ' active-link' : '' }}">
                        <i class="bx bx-building-house nav__icon"></i>
                        <span class="nav__name">Menu</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a href="{{ route('posts') }}" class="nav__link {{ request()->is('posts*') ? ' active-link' : '' }}">
                        <i class="bx bx-news nav__icon"></i>
                        <span class="nav__name">Artikel</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a href="{{ route('contact') }}" class="nav__link {{ request()->is('kontak-kami') ? ' active-link' : '' }}">
                        <i class="bx bx-phone nav__icon"></i>
                        <span class="nav__name">Kontak</span>
                    </a>
                </li>

                @guest
                    <li class="nav__item">
                        <a href="{{ route('login') }}" class="nav__link">
                            <i class="bx bx-log-in nav__icon"></i>
                            <span class="nav__name">Login</span>
                        </a>
                    </li>
                @else
                    <li class="nav__item">
                        @if (Auth::user()->is_admin == 1)
                            <a href="{{ route('admin.dashboard') }}" class="nav__link">
                                <i class="bx bx-grid-alt nav__icon"></i>
                                <span class="nav__name">Dashboard</span>
                            </a>
                        @else
                            <a href="{{ route('profile') }}" class="nav__link {{ request()->is('profile*') ? ' active-link' : '' }}">
                                <i class="bx bx-user-circle nav__icon"></i>
                                <span class="nav__name">Profil</span>
                            </a>
                        @endif
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
</header>
