<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar d-none d-md-block">

    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('admin.index') ? '' : 'collapsed' }}"
                href="{{ route('admin.index') }}">
                <i class="bi bi-grid"></i>
                <span>Dasbor</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('garden.index') ? '' : 'collapsed' }}"
                href="{{ route('garden.index') }}">
                <i class="bi bi-tree-fill"></i>
                <span>Kebun</span>
            </a>
        </li>

        <!-- Spot Tanaman -->
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('map.index') || Request::routeIs('map.create') ? '' : 'collapsed' }}"
                data-bs-target="#map-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-map"></i><span>Spot Tanaman</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="map-nav"
                class="nav-content collapse {{ Request::routeIs('map.index') || Request::routeIs('map.create') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('map.index') }}" class="{{ Request::routeIs('map.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Data Spot</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('map.create') }}" class="{{ Request::routeIs('map.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Tambah Spot</span>
                    </a>
                </li> --}}
            </ul>
        </li>

        <!-- Wilayah -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('province*') || Request::is('city*') || Request::is('district*') || Request::is('village*') ? '' : 'collapsed' }}"
                data-bs-target="#database-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-geo"></i><span>Wilayah</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="database-nav"
                class="nav-content collapse {{ Request::is('province*') || Request::is('city*') || Request::is('district*') || Request::is('village*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('province.index') }}"
                        class="{{ Request::routeIs('province.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Provinsi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('city.index') }}" class="{{ Request::routeIs('city.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Kabupaten/Kota</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('district.index') }}"
                        class="{{ Request::routeIs('district.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Kecamatan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('village.index') }}"
                        class="{{ Request::routeIs('village.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Kelurahan</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin.profile.show', ['username' => '@' . Auth::user()->username]) }}"
                href="{{ route('admin.profile.show', ['username' => '@' . Auth::user()->username]) }}">
                <i class="bi bi-person"></i><span>Profil</span>
            </a>
        </li>

        <!-- Logout -->
        <li class="nav-item mt-3">
            <form action="/logout" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="nav-link btn border-0 shadow-none text-start w-100 text-capitalize"
                    style="color: #626f47">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                </button>
            </form>
        </li>

    </ul>

</aside><!-- End Sidebar -->
