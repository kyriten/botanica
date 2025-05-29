<form id="plant-search-form" class="d-flex justify-content-end pe-md-0 ps-md-0 py-3" method="GET"
    autocomplete="on" action="{{ route('public.search') }}">
    @csrf
    <div class="position-relative w-100" style="max-width: 700px;">
        <div class="input-group" id="search-input-group">
            {{-- Dropdown filter jenis tanaman --}}
            <select name="category" class="form-select form-select-lg rounded-start-pill text-capitalize text-small"
                style="max-width: 200px; font-size: 0.875rem;">
                <option value="">Semua</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>
                        {{ ucfirst(strtolower($cat)) }}
                    </option>
                @endforeach
            </select>

            {{-- Input pencarian --}}
            <input type="text" name="search" id="search-input"
                class="form-control form-control text-small"
                placeholder="Cari taksonomi tanaman ..." value="{{ request('search') }}">

            {{-- Tombol submit --}}
            <button class="btn btn-lg btn-outline-secondary rounded-end-pill" type="submit">
                <i class="bi bi-search fs-4 text-muted"></i>
            </button>
        </div>

        <ul id="autocomplete-list"
            class="list-group position-absolute w-100 shadow-sm mt-1 rounded z-3"
            style="top: 100%; left: 0; display: none;">
        </ul>
    </div>
</form>
