@include('components.maps.modalSelectWilayah')

<!-- ======= Bottom Bar Mobile ======= -->
<nav id="mobile-bottom-bar" class="d-block d-md-none fixed-bottom bg-white border-top shadow">
    <div class="d-flex justify-content-around text-center py-2">

        <!-- Dashboard -->
        <a href="{{ route('admin.index') }}"
            class="small px-2 py-1 rounded {{ Request::routeIs('admin.index') ? 'fw-bold bg-custom text-light' : 'text-dark' }}">
            <i class="bi bi-grid fs-5 d-block"></i>
            <span class="small">Dasbor</span>
        </a>

        <!-- Kebun Raya -->
        <a href="{{ route('garden.index') }}"
            class="small px-2 py-1 rounded {{ Request::routeIs('garden.index') ? 'fw-bold bg-custom text-light' : 'text-dark' }}">
            <i class="bi bi-tree-fill fs-5 d-block"></i>
            <span class="small">Kebun</span>
        </a>

        <!-- Spot Tanaman -->
        <a href="{{ route('map.index') }}"
            class="small px-2 py-1 rounded {{ Request::routeIs('map.index') ? 'fw-bold bg-custom text-light' : 'text-dark' }}">
            <i class="bi bi-map fs-5 d-block"></i>
            <span class="small">Spot</span>
        </a>

        <!-- Wilayah -->
        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#locationSelectModal"
            class="small px-2 py-1 rounded {{ Request::is('province*') || Request::is('city*') || Request::is('district*') || Request::is('village*') ? 'fw-bold bg-custom text-light' : 'text-dark' }}">
            <i class="bi bi-geo fs-5 d-block"></i>
            <span class="small">Wilayah</span>
        </a>

        <!-- Profile -->
        <a href="{{ route('admin.profile.show', ['username' => '@' . Auth::user()->username]) }}"
            class="small px-2 py-1 rounded {{ Request::routeIs('admin.profile.show', ['username' => '@' . Auth::user()->username]) ? 'fw-bold bg-custom text-light' : 'text-dark' }}">
            <i class="bi bi-person fs-5 d-block"></i>
            <span class="small">Profile</span>
        </a>

    </div>
</nav>

<script>
    document.getElementById('confirmLocationBtn').addEventListener('click', function() {
        const selected = document.getElementById('locationSelect').value;
        if (selected) {
            window.location.href = selected;
        } else {
            alert('Silakan pilih wilayah terlebih dahulu.');
        }
    });
</script>
