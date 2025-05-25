<div class="d-flex justify-content-start mb-2 d-md-none d-block">
    <button id="refreshTableBtn" class="btn btn-dark btn-sm" data-url="{{ route('spot.table.refresh') }}">
        <i class="bi bi-arrow-clockwise"></i> Muat Ulang Tabel
    </button>
</div>
<div class="table-responsive">
    <table class="table" id="spot-table">

        <thead>
            <tr>
                <th>
                    <input type="checkbox" id="selectAllCheckbox" />
                </th>
                <th scope="col">No.</th>
                <th scope="col">Jenis Tanaman</th>
                <th scope="col">Famili</th>
                <th scope="col">Nama Lokal</th>
                <th scope="col">Nama Latin</th>
                <th scope="col">Kingdom</th>
                <th scope="col">Sub Kingdom</th>
                <th scope="col">Super Divisi</th>
                <th scope="col">Divisi</th>
                <th scope="col">Kelas</th>
                <th scope="col">Sub Kelas</th>
                <th scope="col">Ordo</th>
                <th scope="col">Genus</th>
                <th scope="col">Spesies</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Foto Keseluruhan (A)</th>
                <th scope="col">Foto Batang (B)</th>
                <th scope="col">Foto Daun (C)</th>
                <th scope="col">Foto Bunga (D)</th>
                <th scope="col">Foto Buah (E)</th>
                <th scope="col">Foto Lain-lain (F)</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Persebaran</th>
                <th scope="col">Latitude</th>
                <th scope="col">Longitude</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($map as $item)
                <tr id="spot-row-{{ $item->id }}">
                    <td>
                        <input type="checkbox" class="spot-checkbox" data-id="{{ $item->id }}">
                    </td>
                    <td>{{ $loop->iteration + ($map->firstItem() - 1) }}</td>
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->famili }}</td>
                    <td>{{ $item->local }}</td>
                    <td>{{ $item->latin }}</td>
                    <td>{{ $item->kingdom }}</td>
                    <td>{{ $item->sub_kingdom }}</td>
                    <td>{{ $item->super_division }}</td>
                    <td>{{ $item->division }}</td>
                    <td>{{ $item->class }}</td>
                    <td>{{ $item->sub_class }}</td>
                    <td>{{ $item->ordo }}</td>
                    <td>{{ $item->genus }}</td>
                    <td>{{ $item->species }}</td>
                    <td>
                        <div class="description-container" style="max-width: 250px;">
                            {{-- Deskripsi singkat --}}
                            <span class="short-description d-block text-truncate" style="max-width: 250px;">
                                {{ Str::limit(strip_tags($item->description), 100) }}
                            </span>

                            {{-- Deskripsi lengkap (berisi HTML, awalnya tersembunyi) --}}
                            <div class="full-description d-none mt-2">
                                {!! $item->description !!}
                            </div>

                            {{-- Tombol toggle --}}
                            @if (strlen(strip_tags($item->description)) > 100)
                                <a href="#" class="toggle-description text-primary"
                                    data-id="{{ $item->id }}">Lihat Selengkapnya</a>
                            @endif
                        </div>
                    </td>

                    <td>
                        @if ($item->plant_image)
                            <img src="{{ asset('storage/' . $item->plant_image) }}" alt="Foto Tanaman"
                                class="img-clickable" style="max-width: 100px; height: auto; cursor: pointer;"
                                data-bs-toggle="modal" data-bs-target="#imageModal"
                                data-imgsrc="{{ asset('storage/' . $item->plant_image) }}">
                        @else
                            <span class="badge badge-warning">Foto belum diunggah</span>
                        @endif
                    </td>

                    <td>
                        @if ($item->stem_image)
                            <img src="{{ asset('storage/' . $item->stem_image) }}" alt="Foto Batang"
                                class="img-clickable" style="max-width: 100px; height: auto; cursor: pointer;"
                                data-bs-toggle="modal" data-bs-target="#imageModal"
                                data-imgsrc="{{ asset('storage/' . $item->stem_image) }}">
                        @else
                            <span class="badge badge-warning">Foto belum diunggah</span>
                        @endif
                    </td>

                    <td>
                        @if ($item->leaf_image)
                            <img src="{{ asset('storage/' . $item->leaf_image) }}" alt="Foto Daun"
                                class="img-clickable" style="max-width: 100px; height: auto; cursor: pointer;"
                                data-bs-toggle="modal" data-bs-target="#imageModal"
                                data-imgsrc="{{ asset('storage/' . $item->leaf_image) }}">
                        @else
                            <span class="badge badge-warning">Foto belum diunggah</span>
                        @endif
                    </td>

                    <td>
                        @if ($item->flower_image)
                            <img src="{{ asset('storage/' . $item->flower_image) }}" alt="Foto Bunga"
                                class="img-clickable" style="max-width: 100px; height: auto; cursor: pointer;"
                                data-bs-toggle="modal" data-bs-target="#imageModal"
                                data-imgsrc="{{ asset('storage/' . $item->flower_image) }}">
                        @else
                            <span class="badge badge-warning">Foto belum diunggah</span>
                        @endif
                    </td>

                    <td>
                        @if ($item->fruit_image)
                            <img src="{{ asset('storage/' . $item->fruit_image) }}" alt="Foto Buah"
                                class="img-clickable" style="max-width: 100px; height: auto; cursor: pointer;"
                                data-bs-toggle="modal" data-bs-target="#imageModal"
                                data-imgsrc="{{ asset('storage/' . $item->fruit_image) }}">
                        @else
                            <span class="badge badge-warning">Foto belum diunggah</span>
                        @endif
                    </td>

                    <td>
                        @if ($item->another_image)
                            <img src="{{ asset('storage/' . $item->another_image) }}" alt="Foto Lainnya"
                                class="img-clickable" style="max-width: 100px; height: auto; cursor: pointer;"
                                data-bs-toggle="modal" data-bs-target="#imageModal"
                                data-imgsrc="{{ asset('storage/' . $item->another_image) }}">
                        @else
                            <span class="badge badge-warning">Foto belum diunggah</span>
                        @endif
                    </td>

                    <td>{{ $item->garden_name }}</td>
                    <td>
                        @if ($item->city_name || $item->province_name)
                            {{ $item->city_name ?? '-' }}, {{ $item->province_name ?? '-' }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->plant_lat }}</td>
                    <td>{{ $item->plant_long }}</td>
                    <td class="action-col">
                        <!-- Tombol edit & hapus untuk desktop (md ke atas) -->
                        <div class="d-none d-md-flex gap-3">
                            <a href="#" class="btn btn-warning btn-edit-spot" data-id="{{ $item->id }}"
                                data-bs-toggle="modal" data-bs-target="#editSpotModal">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('map.destroy', $item->id) }}" method="post" class="d-inline"
                                onsubmit="return confirm('Apakah kamu yakin menghapus data?');">
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
                                        <a href="#" class="dropdown-item btn-edit-spot"
                                            data-id="{{ $item->id }}" data-bs-toggle="modal"
                                            data-bs-target="#editSpotModal">
                                            <i class="bi bi-pencil me-2"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('map.destroy', $item->id) }}" method="post"
                                            onsubmit="return confirm('Apakah kamu yakin menghapus data?');">
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
@if ($map->hasPages())
    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center pagination-circle mt-2">
            {{-- Previous Page Link --}}
            @if ($map->onFirstPage())
                <li class="page-item disabled"><span class="page-link"><i
                            class="bi bi-chevron-double-left"></i></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $map->previousPageUrl() }}"><i
                            class="bi bi-chevron-double-left"></i></a>
                </li>
            @endif

            @php
                $currentPage = $map->currentPage();
                $lastPage = $map->lastPage();
                $start = max($currentPage - 1, 1);
                $end = min($currentPage + 1, $lastPage);
            @endphp

            @if ($start > 1)
                <li class="page-item"><a class="page-link" href="{{ $map->url(1) }}">1</a></li>
                @if ($start > 2)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
            @endif

            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $currentPage)
                    <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $map->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            @if ($end < $lastPage)
                @if ($end < $lastPage - 1)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
                <li class="page-item"><a class="page-link"
                        href="{{ $map->url($lastPage) }}">{{ $lastPage }}</a>
                </li>
            @endif

            @if ($map->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $map->nextPageUrl() }}"><i
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
