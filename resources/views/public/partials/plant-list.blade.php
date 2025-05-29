<div class="list-group">
    @foreach ($plants as $plant)
        <a href="{{ route('plant.show', $plant->id) }}"
            class="list-group-item list-group-item-action py-3 mb-2 mt-2 border-1 rounded"
            style="border-top: 0; border-bottom: 0;">
            <h5 class="mb-1 text-botanica fw-bold">{{ $plant->local }}</h5>
            <div class="d-flex align-items-center justify-content-between">
                <small class="text-muted fst-italic">{{ $plant->latin }}</small>
                <small class="text-danger">
                    <i class="bi bi-geo-alt-fill me-1"></i>
                    {{ $plant->garden_name ?? 'Tidak diketahui' }}
                </small>
            </div>
        </a>
    @endforeach
</div>

@if ($plants->hasPages())
    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center pagination-circle mt-2">
            {{-- Previous Page Link --}}
            @if ($plants->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="bi bi-chevron-double-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $plants->previousPageUrl() }}">
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
                    <a class="page-link" href="{{ $plants->url(1) }}">1</a>
                </li>
                @if ($start > 2)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
            @endif

            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $currentPage)
                    <li class="page-item active">
                        <span class="page-link">{{ $i }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $plants->url($i) }}">{{ $i }}</a>
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
                    <a class="page-link" href="{{ $plants->url($lastPage) }}">{{ $lastPage }}</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($plants->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $plants->nextPageUrl() }}">
                        <i class="bi bi-chevron-double-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="bi bi-chevron-double-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
