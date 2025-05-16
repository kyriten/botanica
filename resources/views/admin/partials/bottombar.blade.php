<!-- ======= Bottom Bar Mobile ======= -->
<nav id="mobile-bottom-bar" class="d-block d-md-none fixed-bottom bg-white border-top shadow">
    <div class="d-flex justify-content-around text-center py-2">

        <!-- Dashboard -->
        <a href="{{ route('admin.index') }}"
            class="small px-2 py-1 rounded {{ Request::routeIs('admin.index') ? 'fw-bold bg-custom text-light' : 'text-dark' }}">
            <i class="bi bi-grid fs-5 d-block"></i>
            <span class="small">Dashboard</span>
        </a>

        <!-- Spot Tanaman -->
        <a href="{{ route('map.index') }}"
            class="small px-2 py-1 rounded {{ Request::routeIs('map.index') ? 'fw-bold bg-custom text-light' : 'text-dark' }}">
            <i class="bi bi-map fs-5 d-block"></i>
            <span class="small">Spot</span>
        </a>

        <!-- Wilayah -->
        <a href="{{ route('province.index') }}"
            class="small px-2 py-1 rounded {{ Request::routeIs('province.index') ? 'fw-bold bg-custom text-light' : 'text-dark' }}">
            <i class="bi bi-geo fs-5 d-block"></i>
            <span class="small">Wilayah</span>
        </a>

        <!-- Profile -->
        <a href="{{ route('admin.profile.show',  ['username' => '@' . Auth::user()->username]) }}"
            class="small px-2 py-1 rounded {{ Request::routeIs('admin.profile.show', ['username' => '@' . Auth::user()->username]) ? 'fw-bold bg-custom text-light' : 'text-dark' }}">
            <i class="bi bi-person fs-5 d-block"></i>
            <span class="small">Profile</span>
        </a>

    </div>
</nav>
