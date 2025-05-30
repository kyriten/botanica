<form id="plant-search-form" class="d-flex justify-content-end justify-content-md-center pe-md-0 ps-md-0 py-3"
    method="GET" autocomplete="on" action="{{ route('public.search') }}">
    @csrf
    <div class="position-relative w-100" style="max-width: 700px;">
        <div class="input-group rounded-pill border border-secondary" id="search-input-group">

            {{-- Icon Search di kiri --}}
            <span class="input-group-text bg-transparent border-0">
                <i class="bi bi-search fs-5 text-muted"></i>
            </span>

            {{-- Input pencarian --}}
            <input type="text" name="search" id="search-input" class="form-control border-0"
                placeholder="Cari taksonomi tanaman ..." value="{{ request('search') }}" autocomplete="off">

            {{-- Dropdown Kategori --}}
            <div class="dropdown">
                <button class="btn btn-transparent border-0 d-flex align-items-center px-3" type="button"
                    id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="height: 100%;">
                    <i class="bi bi-filter fs-5"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                    <li>
                        <a class="dropdown-item {{ request('category') === '' ? 'active' : '' }}" href="#"
                            data-value="">Semua</a>
                    </li>
                    @foreach ($categories as $cat)
                        <li>
                            <a class="dropdown-item {{ request('category') === $cat ? 'active' : '' }}" href="#"
                                data-value="{{ $cat }}">{{ ucfirst(strtolower($cat)) }}</a>
                        </li>
                    @endforeach
                </ul>
                <input type="hidden" name="category" id="category-input" value="{{ request('category') }}">
            </div>

            {{-- Tombol cari berdasarkan kebun (dropdown) --}}
            <div class="dropdown">
                <button class="btn btn-transparent border-0 d-flex align-items-center px-3" type="button"
                    id="gardenDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="height: 100%;"
                    title="Cari berdasarkan Kebun Raya" data-base-url="{{ url('/garden/spots') }}" data-list-url="{{ route('garden.showGardens') }}">
                    <i class="bi bi-tree fs-5 me-1"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="gardenDropdown">
                    <li>
                        <a class="dropdown-item {{ request('garden') === '' ? 'active' : '' }}" href="#"
                            data-value="">Semua Kebun</a>
                    </li>
                    @foreach ($gardens as $garden)
                        <li>
                            <a class="dropdown-item {{ request('garden') === $garden->slug ? 'active' : '' }}"
                                href="#" data-value="{{ $garden->slug }}">{{ $garden->name }}</a>
                        </li>
                    @endforeach
                </ul>
                <input type="hidden" name="garden" id="garden-input" value="{{ request('garden') }}">
            </div>

        </div>

        {{-- Autocomplete --}}
        <ul id="autocomplete-list" class="list-group position-absolute w-100 shadow-sm mt-1 rounded z-3"
            style="top: 100%; left: 0; display: none;">
        </ul>
    </div>
</form>

<style>
    /* Hilangkan border untuk input */
    #search-input {
        border: 1px !important;
        box-shadow: none !important;
    }

    /* Hilangkan border saat input difokus */
    #search-input:focus {
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
    }

    /* Hilangkan border pada tombol dropdown filter */
    #filterDropdown {
        border: none !important;
        box-shadow: none !important;
        border-top-right-radius: 0rem !important;
        border-bottom-right-radius: 0rem !important;
    }

    /* Hilangkan border pada tombol search */
    #search-input-group button {
        border: none !important;
        box-shadow: none !important;
    }

    /* Sesuaikan juga hover agar tetap bersih */
    #filterDropdown:hover {
        background-color: #6c757d11 !important;
        color: #3b3c3d !important;
    }

    #gardenDropdown:hover {
        background-color: #6c757d11 !important;
        color: #3b3c3d !important;
        border-top-right-radius: 50rem !important;
        border-bottom-right-radius: 50rem !important;
    }

    #gardenDropdown {
        border-top-right-radius: 50rem !important;
        border-bottom-right-radius: 50rem !important;
    }

    #search-input-group {
        border: 1px solid #6c757d;
        border-radius: 50rem;
    }

    #search-input,
    #search-input:focus,
    #filterDropdown,
    #filterDropdown:focus,
    .input-group>.btn,
    .input-group>.btn:focus,
    .input-group>.btn:active {
        border: none !important;
        box-shadow: none !important;
        outline: none !important;
    }
</style>
