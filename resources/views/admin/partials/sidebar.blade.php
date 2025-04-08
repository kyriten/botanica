<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('admin.index') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#post-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Posts</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="post-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('post.index') }}">
                        <i class="bi bi-circle"></i><span>View Data Table</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('post.create') }}">
                        <i class="bi bi-circle"></i><span>Insert Data</span>
                    </a>
                </li>
            </ul>
        </li><!-- End post Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed {{ Request::routeIs('map.index') || Request::routeIs('map.create') ? 'collapse active' : 'collapsed' }}" data-bs-target="#map-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-map"></i><span>Peta</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="map-nav" class="nav-content collapse {{ Request::routeIs('map.index') || Request::routeIs('map.create') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ Request::routeIs('map.index') ? 'active' : 'collapsed' }}"
                    href="{{ route('map.index') }}">
                        <i class="bi bi-circle"></i><span>Lihat Data Pin</span>
                    </a>
                </li>
                <li>
                    <a class="{{ Request::routeIs('map.create') ? 'active' : 'collapsed' }}"
                    href="{{ route('map.create') }}">
                        <i class="bi bi-circle"></i><span>Tambah Pin</span>
                    </a>
                </li>
            </ul>
        </li><!-- End post Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('province.index') || Request::routeIs('city.index') || Request::routeIs('district.index') || Request::routeIs('village.index') ? 'collapse active' : 'collapsed' }}"
                data-bs-target="#database-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-geo"></i><span>Wilayah</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="database-nav"
                class="nav-content collapse {{ Request::routeIs('province.index') || Request::routeIs('city.index') || Request::routeIs('district.index') || Request::routeIs('village.index') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ Request::routeIs('province.index') ? 'active' : 'collapsed' }}"
                        href="{{ route('province.index') }}">
                        <i class="bi bi-circle"></i><span>Provinsi </span>
                    </a>
                </li>

                <li>
                    <a class="{{ Request::routeIs('city.index') ? 'active' : 'collapsed' }}"
                        href="{{ route('city.index') }}">
                        <i class="bi bi-circle"></i><span>Kabupaten/Kota </span>
                    </a>
                </li>

                <li>
                    <a class="{{ Request::routeIs('district.index') ? 'active' : 'collapsed' }}"
                        href="{{ route('district.index') }}">
                        <i class="bi bi-circle"></i><span>Kecamatan </span>
                    </a>
                </li>

                <li>
                    <a class="{{ Request::routeIs('village.index') ? 'active' : 'collapsed' }}"
                        href="{{ route('village.index') }}">
                        <i class="bi bi-circle"></i><span>Kelurahan </span>
                    </a>
                </li>
            </ul>
        </li><!-- End post Nav -->

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>F.A.Q</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

    </ul>

</aside><!-- End Sidebar-->
