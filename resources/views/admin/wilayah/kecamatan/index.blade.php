@extends('admin.app')

@section('dbDistrict')
    <main id="main" class="main">
        <div class="pagetitle">
            <div class="row">
                <h2 class="text-dark fw-bold text-wrap mb-4">Data Kecamatan di Indonesia</h2>
            </div>
        </div><!-- End Page Title -->
        <div class="row">
            <div class="col-lg-4 d-flex justify-content-start align-items-center mb-3">
                <a class="btn btn-primary fw-bold text-light"
                    href="{{ route('district.create') }}">{{ __('Kecamatan Baru') }}</a>
            </div>
            <div class="col-lg-8 d-flex justify-content-end align-items-center mb-3">
                <div class="search-bar">
                    <form action="{{ route('district.index') }}" method="GET" class="search-form">
                        <div class="input-group rounded">
                            <input type="text" name="search" class="form-control" placeholder="Cari kecamatan"
                                value="{{ request('search') }}">
                            <span class="input-group-text border-0" id="search-addon">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </form>
                </div>
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

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Kecamatan</th>
                                            <th scope="col">Latitude</th>
                                            <th scope="col">Longitude</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($districts as $item)
                                            @php
                                                $iterationNumber =
                                                    ($districts->currentPage() - 1) * $districts->perPage() +
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
                                                        {{-- <a class="btn btn-warning" href="/map/{{ $item->id }}/edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </a> --}}
                                                        <form action="{{ route('district.destroy', $item->id) }}" method="post"
                                                            class="d-inline">
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
                                    <!-- Bagian untuk menampilkan tautan paginate -->
                                </table>

                            </div>
                            @if ($districts->hasPages())
                                <nav aria-label="Pagination">
                                    <ul class="pagination justify-content-center pagination-circle">
                                        {{-- Previous Page Link --}}
                                        @if ($districts->onFirstPage())
                                            <li class="page-item disabled"><span class="page-link">Sebelumnya</span></li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $districts->previousPageUrl() }}">Sebelumnya</a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @php
                                            $currentPage = $districts->currentPage();
                                            $lastPage = $districts->lastPage();
                                            $start = max($currentPage - 1, 1);
                                            $end = min($currentPage + 1, $lastPage);
                                        @endphp

                                        {{-- Jika halaman awal lebih dari 1, tampilkan halaman pertama --}}
                                        @if ($start > 1)
                                            <li class="page-item"><a class="page-link" href="{{ $districts->url(1) }}">1</a>
                                            </li>
                                            @if ($start > 2)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif
                                        @endif

                                        {{-- Range halaman dinamis --}}
                                        @for ($i = $start; $i <= $end; $i++)
                                            @if ($i == $currentPage)
                                                <li class="page-item active" aria-current="page"><span
                                                        class="page-link">{{ $i }}</span></li>
                                            @else
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $districts->url($i) }}">{{ $i }}</a></li>
                                            @endif
                                        @endfor

                                        {{-- Jika halaman akhir lebih kecil dari total halaman, tampilkan halaman terakhir --}}
                                        @if ($end < $lastPage)
                                            @if ($end < $lastPage - 1)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $districts->url($lastPage) }}">{{ $lastPage }}</a></li>
                                        @endif

                                        {{-- Next Page Link --}}
                                        @if ($districts->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $districts->nextPageUrl() }}">Selanjutnya</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled"><span class="page-link">Selanjutnya</span></li>
                                        @endif
                                    </ul>
                                </nav>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End main -->
@endsection
