<form id="plant-search-form" class="d-flex justify-content-end ps-3 pe-1 pe-md-0 ps-md-0 py-3" method="GET"
    autocomplete="on" action="{{ route('public.search') }}">
    @csrf
    <div class="position-relative w-100" style="max-width: 600px;">
        <div class="input-group" id="search-input-group">
            <input type="text" name="search" id="search-input" class="form-control form-control-lg rounded-pill ps-4 text-small"
                placeholder="Cari taksonomi tanaman ..." value="{{ request('search') }}" style="border-right: none;">
            <button class="btn btn-lg rounded-pill border-start-0" type="submit"
                style="margin-left: -60px; z-index: 5;">
                <i class="bi bi-search fs-4 text-muted"></i>
            </button>
        </div>

        <ul id="autocomplete-list" class="list-group position-absolute w-100 shadow-sm mt-1 rounded z-3"
            style="top: 100%; left: 0; display: none;">
        </ul>
    </div>
</form>
