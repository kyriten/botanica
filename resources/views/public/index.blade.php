@extends('public.app')

@section('content')
    <div class="container py-5">
        <!-- Google-style header -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-primary">{{ config('app.name') }}</h1>
            <p class="lead text-muted">Temukan informasi tanaman berdasarkan nama lokal atau nama latin</p>

            <!-- Search Form -->
            <form id="plant-search-form" class="d-flex justify-content-center mt-4" method="GET" autocomplete="on">
                @csrf
                <div class="input-group w-100 w-md-75 w-lg-50">
                    <input type="text" name="search" id="search-input"
                        class="form-control form-control-lg rounded-start-pill"
                        placeholder="Contoh: Jahe atau Zingiber officinale" value="{{ request('search') }}">

                    <button class="btn btn-outline-primary btn-lg rounded-end-pill" type="submit">
                        <i class="bi bi-search"></i>
                    </button>

                    <!-- Saran pencarian -->
                    <ul id="autocomplete-list" class="list-group position-absolute w-100 z-3" style="top: 100%; left: 0;">
                    </ul>
                </div>
            </form>

        </div>

        <!-- Spinner -->
        <div id="loading-spinner" class="text-center my-4 d-none">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <!-- Search Results -->
        <div id="search-results" class="mt-4">
            @include('public.partials.plant-list', ['plants' => $plants])
        </div>
    </div>
@endsection

@push('styles')
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        #search-input::placeholder {
            color: #adb5bd;
            opacity: 1;
        }
    </style>
@endpush

@push('scripts')
    <script>
        const input = document.getElementById('search-input');
        const spinner = document.getElementById('loading-spinner');
        const results = document.getElementById('search-results');
        let timeout = null;

        // Ketika mengetik, lakukan pencarian secara otomatis (debounced)
        input.addEventListener('input', function() {
            clearTimeout(timeout);

            const query = input.value.trim();

            if (query === '') {
                // Jika input kosong, tampilkan tampilan default tanpa hasil pencarian
                spinner.classList.remove('d-none');
                fetch(`{{ route('public.search') }}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        spinner.classList.add('d-none');
                        results.innerHTML = html;
                    })
                    .catch(() => {
                        spinner.classList.add('d-none');
                        results.innerHTML = '<p class="text-danger text-center">Gagal memuat data.</p>';
                    });
                return;
            }

            // Jika input tidak kosong, jalankan pencarian
            timeout = setTimeout(() => {
                const searchQuery = new URLSearchParams({
                    search: query
                }).toString();

                spinner.classList.remove('d-none');
                results.innerHTML = '';

                fetch(`{{ route('public.search') }}?${searchQuery}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        spinner.classList.add('d-none');
                        results.innerHTML = html;
                    })
                    .catch(() => {
                        spinner.classList.add('d-none');
                        results.innerHTML = '<p class="text-danger text-center">Gagal memuat data.</p>';
                    });
            }, 500);
        });
    </script>

    <script>
        document.getElementById('plant-search-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;
            const query = new URLSearchParams(new FormData(form)).toString();

            // Tampilkan spinner, kosongkan hasil sebelumnya
            document.getElementById('loading-spinner').classList.remove('d-none');
            document.getElementById('search-results').innerHTML = '';

            fetch(`{{ route('public.search') }}?${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => {
                    document.getElementById('loading-spinner').classList.add('d-none');
                    document.getElementById('search-results').innerHTML = html;
                })
                .catch(() => {
                    document.getElementById('loading-spinner').classList.add('d-none');
                    document.getElementById('search-results').innerHTML =
                        '<p class="text-danger text-center">Terjadi kesalahan saat memuat hasil.</p>';
                });
        });
    </script>

    <script>
        const searchInput = document.getElementById('search-input');
        const autocompleteList = document.getElementById('autocomplete-list');

        // Fungsi debounce
        function debounce(fn, delay) {
            let timeoutId;
            return function(...args) {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => fn.apply(this, args), delay);
            };
        }

        // Fungsi fetch data saran
        const fetchSuggestions = debounce(function() {
            const query = searchInput.value;
            if (query.length < 2) {
                autocompleteList.innerHTML = '';
                return;
            }

            fetch(`{{ route('plant.autocomplete') }}?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    autocompleteList.innerHTML = '';
                    data.forEach(plant => {
                        const item = document.createElement('li');
                        item.classList.add('list-group-item', 'list-group-item-action');
                        item.textContent = `${plant.local} (${plant.latin})`;
                        item.addEventListener('click', function() {
                            searchInput.value = plant.local;
                            autocompleteList.innerHTML = '';
                            document.getElementById('plant-search-form').dispatchEvent(
                                new Event('submit'));
                        });
                        autocompleteList.appendChild(item);
                    });
                });
        }, 300); // 300ms debounce delay

        searchInput.addEventListener('input', fetchSuggestions);

        document.addEventListener('click', function(e) {
            if (!autocompleteList.contains(e.target) && e.target !== searchInput) {
                autocompleteList.innerHTML = '';
            }
        });
    </script>
@endpush
