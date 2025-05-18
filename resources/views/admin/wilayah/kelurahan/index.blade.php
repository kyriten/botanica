@extends('admin.app')

@section('dbVillage')
    <main id="main" class="main">
        <div class="pagetitle d-none d-md-block">
            <div class="row">
                <h2 class="text-dark fw-bold text-wrap mb-4">Data Kelurahan/Desa di Indonesia</h2>
            </div>
        </div><!-- End Page Title -->

        <div class="row align-items-center gy-2 mb-3">
            <div class="col-3 col-md-8 col-lg-9 d-flex justify-content-start">
                <div class="row g-3 my-3">
                    <div class="col-12 col-md-8">
                        <!-- Toggle Button untuk Mobile -->
                        <div class="d-block d-md-none mb-2">
                            <button class="btn btn-outline-botanica btn-sm" type="button" data-bs-toggle="collapse"
                                data-bs-target="#actionButtonsCollapse" aria-expanded="false"
                                aria-controls="actionButtonsCollapse">
                                <i class="bi bi-list me-1"></i>
                            </button>
                        </div>

                        <!-- Tombol (mobile - collapsible) -->
                        <div class="collapse d-md-none mt-2" id="actionButtonsCollapse">
                            <div class="d-flex flex-column gap-2">
                                {{-- Tombol Add --}}
                                <a class="btn btn-sm btn-botanica fw-bold text-light d-flex align-items-center justify-content-center gap-2 w-100"
                                    href="{{ route('village.create') }}">
                                    <i class="fas fa-plus"></i>
                                </a>

                                {{-- Tombol Select Wilayah --}}
                                <div class="dropdown w-100">
                                    <button
                                        class="btn btn-secondary btn-sm d-flex align-items-center justify-content-center gap-2 w-100 no-caret"
                                        type="button" id="selectWilayahDropdownMobile" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="bi bi-arrow-left-right"></i>
                                    </button>

                                    <ul class="dropdown-menu w-100" aria-labelledby="selectWilayahDropdownMobile">
                                        <li><a class="dropdown-item" href="{{ route('province.index') }}">Provinsi</a></li>
                                        <li><a class="dropdown-item" href="{{ route('city.index') }}">Kota</a></li>
                                        <li><a class="dropdown-item" href="{{ route('district.index') }}">Kecamatan</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol (desktop - selalu tampil) -->
                        <div class="d-none d-md-flex flex-wrap gap-2">
                            {{-- Tombol Add --}}
                            <a class="btn btn-sm btn-botanica fw-bold text-light d-flex align-items-center gap-2"
                                href="{{ route('village.create') }}">
                                <i class="fas fa-plus"></i>
                                <span class="d-none d-md-inline">Kelurahan/Desa Baru</span>
                            </a>

                            {{-- Tombol Select Wilayah --}}
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle btn-sm d-flex align-items-center gap-2"
                                    type="button" id="selectWilayahDropdownDesktop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-arrow-left-right"></i> <span class="d-none d-md-inline">Pilih
                                        Wilayah</span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="selectWilayahDropdownDesktop">
                                    <li><a class="dropdown-item" href="{{ route('province.index') }}">Provinsi</a></li>
                                    <li><a class="dropdown-item" href="{{ route('city.index') }}">Kota</a></li>
                                    <li><a class="dropdown-item" href="{{ route('district.index') }}">Kecamatan</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Search --}}
            <div class="col-9 col-md-8 col-lg-9 d-flex justify-content-end">
                <form action="{{ route('village.index') }}" method="GET" class="search-form">
                    <div class="input-group rounded toggle-search w-100" id="searchContainer">
                        <input type="text" name="search" class="form-control" id="searchInput"
                            placeholder="Cari kelurahan/desa" value="{{ request('search') }}">
                        <span class="input-group-text border-0" id="searchToggle" style="cursor: pointer;">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <section class="section">
            <div class="row">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="col-lg-12">
                    <div class="card pb-5 pb-md-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Kelurahan/Desa</th>
                                            <th scope="col">Latitude</th>
                                            <th scope="col">Longitude</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($villages as $item)
                                            @php
                                                $iterationNumber =
                                                    ($villages->currentPage() - 1) * $villages->perPage() +
                                                    $loop->index +
                                                    1;
                                            @endphp
                                            <tr>
                                                <td>{{ $iterationNumber }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->latitude }}</td>
                                                <td>{{ $item->longitude }}</td>
                                                <td>
                                                    <div class="d-flex gap-3">
                                                        <form action="{{ route('village.destroy', $item->id) }}"
                                                            method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger"
                                                                onclick="return confirm('Apa kamu yakin untuk menghapus data?')">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No records available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @if ($villages->hasPages())
                                <nav aria-label="Pagination">
                                    <ul class="pagination justify-content-center pagination-circle mt-2">
                                        {{-- Previous Page Link --}}
                                        @if ($villages->onFirstPage())
                                            <li class="page-item disabled"><span class="page-link"><i
                                                        class="bi bi-chevron-double-left"></i></span></li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $villages->previousPageUrl() }}"><i
                                                        class="bi bi-chevron-double-left"></i></a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @php
                                            $currentPage = $villages->currentPage();
                                            $lastPage = $villages->lastPage();
                                            $start = max($currentPage - 1, 1);
                                            $end = min($currentPage + 1, $lastPage);
                                        @endphp

                                        @if ($start > 1)
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $villages->url(1) }}">1</a></li>
                                            @if ($start > 2)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif
                                        @endif

                                        @for ($i = $start; $i <= $end; $i++)
                                            @if ($i == $currentPage)
                                                <li class="page-item active" aria-current="page"><span
                                                        class="page-link">{{ $i }}</span></li>
                                            @else
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $villages->url($i) }}">{{ $i }}</a></li>
                                            @endif
                                        @endfor

                                        @if ($end < $lastPage)
                                            @if ($end < $lastPage - 1)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $villages->url($lastPage) }}">{{ $lastPage }}</a></li>
                                        @endif

                                        {{-- Next Page Link --}}
                                        @if ($villages->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $villages->nextPageUrl() }}"><i
                                                        class="bi bi-chevron-double-right"></i></a>
                                            </li>
                                        @else
                                            <li class="page-item disabled"><span class="page-link"><i
                                                        class="bi bi-chevron-double-right"></i></span></li>
                                        @endif
                                    </ul>
                                </nav>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
