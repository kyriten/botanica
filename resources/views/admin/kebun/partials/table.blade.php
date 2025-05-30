<div class="table-responsive">
    <table class="table" id="garden-table">

        <thead>
            <tr>
                <th>
                    <input type="checkbox" id="selectAllCheckbox" />
                </th>
                <th scope="col">No.</th>
                <th scope="col">Nama Kebun Raya</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($gardens as $item)
                <tr id="garden-row-{{ $item->id }}">
                    <td>
                        <input type="checkbox" class="garden-checkbox" data-id="{{ $item->id }}">
                    </td>
                    <td>{{ $loop->iteration + ($gardens->firstItem() - 1) }}</td>
                    <td>{{ $item->name ?? '-' }}</td>
                    <td class="action-col">
                        <!-- Tombol edit & hapus untuk desktop (md ke atas) -->
                        <div class="d-none d-md-flex gap-3">
                            <a href="#" class="btn btn-warning btn-edit-garden" data-slug="{{ $item->slug }}"
                                data-bs-toggle="modal" data-bs-target="#editGardenModal">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('garden.destroy', $item->slug) }}" method="post" class="d-inline"
                                onsubmit="return confirm('Apakah kamu yakin menghapus kebun?');">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" type="submit">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Tombol titik tiga dengan dropdown untuk mobile (sm ke bawah) -->
                        <div class="d-flex d-md-none" style="position: relative; z-index: 1051;">
                            <div class="dropdown dropup">
                                <button class="btn btn-secondary btn-sm p-1 dropdown-toggle no-arrow p-0" type="button"
                                    id="dropdownMenuButton{{ $item->id }}" data-bs-toggle="dropdown"
                                    data-bs-display="static" aria-expanded="false"
                                    style="width: 2.5rem; height: 2.5rem;">
                                    <i class="bi bi-three-dots-vertical fs-5"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="dropdownMenuButton{{ $item->id }}"
                                    style="position: absolute !important; bottom: 100% !important; top: auto !important; margin-bottom: 0.125rem !important; z-index: 1050 !important;">
                                    <li>
                                        <a href="#" class="dropdown-item btn-edit-garden"
                                            data-slug="{{ $item->slug }}" data-bs-toggle="modal"
                                            data-bs-target="#editGardenModal">
                                            <i class="bi bi-pencil me-2"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('garden.destroy', $item->slug) }}" method="post"
                                            onsubmit="return confirm('Apakah kamu yakin menghapus kebun?');">
                                            @method('delete')
                                            @csrf
                                            <button class="dropdown-item text-danger" type="submit">
                                                <i class="bi bi-trash me-2"></i> Hapus
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="27" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse

        </tbody>
        <!-- Bagian untuk menampilkan tautan paginate -->
    </table>
</div>
@if ($gardens->hasPages())
    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center pagination-circle mt-2">
            {{-- Previous Page Link --}}
            @if ($gardens->onFirstPage())
                <li class="page-item disabled"><span class="page-link"><i
                            class="bi bi-chevron-double-left"></i></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $gardens->previousPageUrl() }}"><i
                            class="bi bi-chevron-double-left"></i></a>
                </li>
            @endif

            @php
                $currentPage = $gardens->currentPage();
                $lastPage = $gardens->lastPage();
                $start = max($currentPage - 1, 1);
                $end = min($currentPage + 1, $lastPage);
            @endphp

            @if ($start > 1)
                <li class="page-item"><a class="page-link" href="{{ $gardens->url(1) }}">1</a></li>
                @if ($start > 2)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
            @endif

            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $currentPage)
                    <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $gardens->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            @if ($end < $lastPage)
                @if ($end < $lastPage - 1)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
                <li class="page-item"><a class="page-link"
                        href="{{ $gardens->url($lastPage) }}">{{ $lastPage }}</a>
                </li>
            @endif

            @if ($gardens->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $gardens->nextPageUrl() }}"><i
                            class="bi bi-chevron-double-right"></i></a>
                </li>
            @else
                <li class="page-item disabled"><span class="page-link"><i
                            class="bi bi-chevron-double-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif

