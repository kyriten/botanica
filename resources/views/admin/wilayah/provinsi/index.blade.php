@extends('admin.app')

@section('dbProvinsi')
    <main id="main" class="main">
        <div class="pagetitle">
            <div class="row">
                <h2 class="text-dark fw-bold text-wrap mb-4">Data Provinsi di Indonesia</h2>
            </div>
        </div><!-- End Page Title -->
        <div class="row">
            <div class="col-lg-4 d-flex justify-content-start align-items-center mb-3">
                <a class="btn btn-botanica fw-bold text-light"
                    href="{{ route('province.create') }}">{{ __('Provinsi Baru') }}</a>
            </div>
            <div class="col-lg-8 d-flex justify-content-end align-items-center mb-3">
                <div class="search-bar">
                    <form action="{{ route('province.index') }}" method="GET" class="search-form">
                        <div class="input-group rounded">
                            <input type="text" name="search" class="form-control" placeholder="Cari provinsi"
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
                                            <th scope="col">Nama Provinsi</th>
                                            <th scope="col">Latitude</th>
                                            <th scope="col">Longitude</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($provinces as $item)
                                            @php
                                                $iterationNumber =
                                                    ($provinces->currentPage() - 1) * $provinces->perPage() +
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
                                                        <form action="{{ route('province.destroy', $item->id) }}"
                                                            method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger"
                                                                onclick="return confirm('Are you sure to delete your data?')">
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
                            @if ($provinces->hasPages())
                                <nav aria-label="Pagination">
                                    <ul class="pagination justify-content-center pagination-circle">
                                        {{-- Previous Page Link --}}
                                        @if ($provinces->onFirstPage())
                                            <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $provinces->previousPageUrl() }}">Previous</a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @php
                                            $currentPage = $provinces->currentPage();
                                            $lastPage = $provinces->lastPage();
                                            $start = max($currentPage - 1, 1);
                                            $end = min($currentPage + 1, $lastPage);
                                        @endphp

                                        {{-- Jika start lebih dari 1, tampilkan halaman pertama --}}
                                        @if ($start > 1)
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $provinces->url(1) }}">1</a></li>
                                            @if ($start > 2)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif
                                        @endif

                                        @for ($page = $start; $page <= $end; $page++)
                                            @if ($page == $provinces->currentPage())
                                                <li class="page-item active" aria-current="page">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $provinces->url($page) }}">{{ $page }}</a></li>
                                            @endif
                                        @endfor

                                        {{-- Jika end kurang dari lastPage, tampilkan halaman terakhir --}}
                                        @if ($end < $lastPage)
                                            @if ($end < $lastPage - 1)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $provinces->url($lastPage) }}">{{ $lastPage }}</a></li>
                                        @endif

                                        {{-- Next Page Link --}}
                                        @if ($provinces->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $provinces->nextPageUrl() }}">Next</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled"><span class="page-link">Next</span></li>
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
