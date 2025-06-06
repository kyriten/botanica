<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center d-md-none justify-content-between w-100">
        <a href="{{ route('admin.index') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('images/logo.png') }}" alt="logo" style="height: 30px;">
        </a>

        @if (request()->routeIs('province.*'))
            <h2 class="mb-0 fs-5 fw-bold text-dark text-wrap flex-grow-1 text-center text-botanica mx-2">Data Provinsi di
                Indonesia</h2>
        @endif

        @if (request()->routeIs('city.*'))
            <h2 class="mb-0 fs-5 fw-bold text-dark text-wrap flex-grow-1 text-center text-botanica mx-2">Data Kota di
                Indonesia</h2>
        @endif

        @if (request()->routeIs('district.*'))
            <h2 class="mb-0 fs-5 fw-bold text-dark text-wrap flex-grow-1 text-center text-botanica mx-2">Data Kecamatan di
                Indonesia</h2>
        @endif

        @if (request()->routeIs('village.*'))
            <h2 class="mb-0 fs-5 fw-bold text-dark text-wrap flex-grow-1 text-center text-botanica mx-2">Data Kelurahan di
                Indonesia</h2>
        @endif
    </div>

    <div class="d-flex align-items-center justify-content-between d-none d-md-flex">
        <a href="{{ route('admin.index') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('images/logo.png') }}" alt="logo">
            <span class="fs-4">{{ config('app.name') }}</span>
        </a>

        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            {{-- <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li> --}}
            <!-- End Search Icon-->

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->username }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ auth()->user()->username }}</h6>
                        <span>Admin</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center"
                            href="{{ route('admin.profile.show', ['username' => '@' . Auth::user()->username]) }}">
                            <i class="bi bi-person me-2"></i>
                            Profil
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="dropdown-item d-flex align-items-center" type="submit" href="/logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </button>
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
