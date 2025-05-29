@php
    $searching = $hasSearch ?? false;
    $activeTab = request()->input('tab', 'image');
@endphp

@if ($plants->count())
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-2 g-md-3">
        @foreach ($plants as $plant)
            <div class="col">
                <a href="{{ route('plant.show', $plant->id) }}" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm border-0 rounded-2 overflow-hidden">
                        <!-- Gambar Tanaman kecil -->
                        <div style="aspect-ratio: 1 / 1; overflow: hidden;">
                            <img src="{{ $plant->plant_image ? asset('storage/' . $plant->plant_image) : asset('images/no-image.png') }}"
                                class="img-fluid object-fit-cover" alt="Gambar {{ $plant->local }}"
                                style="object-fit: cover; width: 100%; height: 100%; display: block;">
                        </div>

                        <div class="card-body p-2">
                            <h6 class="card-title text-primary mb-0 text-truncate" title="{{ $plant->local }}">{{ $plant->local }}</h6>
                            <p class="card-subtitle text-muted mb-1 small fst-italic text-truncate" title="{{ $plant->latin }}">{{ $plant->latin }}</p>
                            <p class="card-text text-truncate small" title="{{ $plant->description }}">{{ $plant->description }}</p>
                            <p class="card-text small mb-0 text-truncate">
                                <i class="bi bi-geo-alt-fill me-1 text-danger"></i>
                                <strong title="{{ $plant->garden_name ?? 'Tidak diketahui' }}">{{ $plant->garden_name ?? 'Tidak diketahui' }}</strong>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endif

@if ($plants->hasPages())
    <nav aria-label="Pagination">
        <ul class="pagination pagination-circle pagination-sm justify-content-center mt-2 flex-wrap">
            {{-- Previous Page Link --}}
            @if ($plants->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link" aria-disabled="true">
                        <i class="bi bi-chevron-double-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)"
                        onclick="loadTabPage('{{ $plants->previousPageUrl() }}', 'image')" aria-label="Previous">
                        <i class="bi bi-chevron-double-left"></i>
                    </a>
                </li>
            @endif

            @php
                $currentPage = $plants->currentPage();
                $lastPage = $plants->lastPage();
                $start = max($currentPage - 1, 1);
                $end = min($currentPage + 1, $lastPage);
            @endphp

            @if ($start > 1)
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)"
                        onclick="loadTabPage('{{ $plants->url(1) }}', 'image')">1</a>
                </li>
                @if ($start > 2)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
            @endif

            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $currentPage)
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">{{ $i }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0)"
                            onclick="loadTabPage('{{ $plants->url($i) }}', 'image')">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            @if ($end < $lastPage)
                @if ($end < $lastPage - 1)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)"
                        onclick="loadTabPage('{{ $plants->url($lastPage) }}', 'image')">{{ $lastPage }}</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($plants->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)"
                        onclick="loadTabPage('{{ $plants->nextPageUrl() }}', 'image')" aria-label="Next">
                        <i class="bi bi-chevron-double-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link" aria-disabled="true">
                        <i class="bi bi-chevron-double-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
