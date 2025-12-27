    <header class="header" id="header">
        <nav class="nav container">
            <a href="{{ route('home') }}" class="nav__logo"><img width="250" style="height: 70px; object-fit: cover" src="{{ asset('frontend/assets/images/icon_web.png') }}" alt="logo" /></a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="{{ route('home') }}" class="nav__link {{ request()->is('/') ? ' active-link' : '' }}"">
                            <i class="bx bx-home-alt nav__icon"></i>
                            <span class="nav__name">Home</span>
                        </a>
                    </li>

                    <!-- <li class="nav__item">
              <a href="#about" class="nav__link">
                <i class="bx bx-user nav__icon"></i>
                <span class="nav__name">About</span>
              </a>
            </li> -->

                    <li class="nav__item">
                        <a href="{{ route('posts') }}" class="nav__link {{ request()->is('posts*') ? ' active-link' : '' }}"">
                            <i class="bx bx-book-alt nav__icon"></i>
                            <span class="nav__name">Berita</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="{{ route('package') }}" class="nav__link {{ request()->is('paket-travel*') ? ' active-link' : '' }}">
                            <i class="bx bx-briefcase-alt nav__icon"></i>
                            <span class="nav__name">Paket Travel</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="{{ route('contact') }}" class="nav__link {{ request()->is('kontak-kami') ? ' active-link' : '' }}"">
                            <i class="bx bx-message-square-detail nav__icon"></i>
                            <span class="nav__name">Kontak Kami</span>
                        </a>
                    </li>

                    @guest

                        <li class="nav__item">
                            <a href="{{ route('login') }}" class="nav__link">
                                <i class="bx bx-user nav__icon"></i>
                                <span class="nav__name">Login</span>
                            </a>
                        </li>
                    @else
                        @if (Auth::user()->is_admin == 1)
                            <li class="nav__item">
                                <a href="{{ route('admin.dashboard') }}" class="nav__link">
                                    <i class="bx bx-user nav__icon"></i>
                                    <span class="nav__name">Dashboard</span>
                                </a>
                            </li>
                        @else
                            <li class="nav__item">
                                <a href="{{ route('profile') }}" class="nav__link {{ request()->is('profile*') ? ' active-link' : '' }}">
                                    <i class="bx bx-user nav__icon"></i>
                                    <span class="nav__name">Profile</span>
                                </a>
                            </li>
                            {{-- <li class="nav__item">
                                <a href="{{ route('logout') }}" class="nav__link"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bx bx-user nav__icon"></i>
                                    <span class="nav__name">Logout</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li> --}}
                        @endif
                    @endguest

                </ul>
            </div>
        </nav>
    </header>
