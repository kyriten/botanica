<script>
    const searchInput = document.getElementById('search-input');
    const autocompleteList = document.getElementById('autocomplete-list');
    const form = document.getElementById('plant-search-form');
    const spinner = document.getElementById('loading-spinner');
    const results = document.getElementById('search-results');

    // Debounce helper
    function debounce(fn, delay) {
        let timeoutId;
        return function(...args) {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => fn.apply(this, args), delay);
        };
    }

    // Fetch and render autocomplete suggestions
    const fetchSuggestions = debounce(function() {
        const query = searchInput.value.trim();
        if (query.length < 2) {
            autocompleteList.innerHTML = '';
            autocompleteList.style.display = 'none';
            return;
        }

        fetch(`{{ route('plant.autocomplete') }}?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                autocompleteList.innerHTML = '';
                if (data.length === 0) {
                    autocompleteList.style.display = 'none';
                    return;
                }

                data.forEach(plant => {
                    const item = document.createElement('li');
                    item.classList.add('list-group-item', 'list-group-item-action');
                    item.textContent = `${plant.local} (${plant.latin})`;
                    item.onclick = () => {
                        searchInput.value = plant.local;
                        autocompleteList.innerHTML = '';
                        form.dispatchEvent(new Event('submit'));
                    };
                    autocompleteList.appendChild(item);
                });

                autocompleteList.style.display = 'block';
            });
    }, 300);

    searchInput.addEventListener('input', fetchSuggestions);

    // Hide suggestions when clicking outside
    document.addEventListener('click', function(e) {
        if (!autocompleteList.contains(e.target) && e.target !== searchInput) {
            autocompleteList.innerHTML = '';
            autocompleteList.style.display = 'none';
        }
    });

    // AJAX form submit
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const query = new URLSearchParams(new FormData(form)).toString();

        spinner.classList.remove('d-none');
        results.innerHTML = '';

        fetch(`{{ route('public.search') }}?${query}`, {
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
                results.innerHTML =
                    '<p class="text-danger text-center">Terjadi kesalahan saat memuat hasil.</p>';
            });
    });

    // Optional: fetch default data when input is cleared
    searchInput.addEventListener('input', debounce(() => {
        const query = searchInput.value.trim();
        if (query === '') {
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
        }
    }, 500));
</script>
