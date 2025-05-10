@extends('admin.app')
@section('post')
    @include('components.maps.modalSelectGarden')

    @include('components.maps.modalInputSpot')

    @include('components.maps.modalEditSpot')

    @include('components.maps.modalImportSpot')

    @include('components.maps.modalGambarSpot')

    <main class="main" id="main">
        <div id="skeletonArea">
            <div class="pagetitle">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-lg-3">
                        <div class="skeleton" style="height: 100px;"></div>
                    </div>

                    <div class="col-lg-3">
                        <div class="skeleton" style="height: 50px;"></div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="skeleton" style="height: 300px;"></div>
                </div>
                <div class="col-lg-12">
                    <div class="skeleton" style="height: 500px;"></div>
                </div>
            </div>
        </div>

        <div class="pagetitle" id="titleArea" style="display:none;">
            <div class="row fade-in">
                <div class="col-lg-6 align-items-center">
                    <h1 id="pageTitle"></h1>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('map.index') }}">Peta</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('map.index') }}">Daftar Spot Tanaman</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div><!-- End Page Title -->

        <section class="section" id="contentArea" style="display:none;">
            <div class="row fade-in">
                <div id="alert-container"></div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8 d-flex justify-content-start align-items-stretch my-3">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#inputSpotModal"><i class="bi bi-plus-lg me-1"></i> Tambah
                                        Spot</button>

                                    <button class="btn btn-secondary btn-sm mx-2" data-bs-toggle="modal"
                                        data-bs-target="#importListSpotModal"><i class="bi bi-cloud-upload-fill me-1"></i>
                                        Impor Daftar Spot</button>
                                </div>

                                <div class="col-lg-4 d-flex justify-content-end align-items-stretch my-3">
                                    <div class="search-bar">
                                        <form id="search-form" action="{{ route('map.index') }}" method="GET"
                                            class="search-form">
                                            <div class="input-group rounded">
                                                <input type="text" name="search" class="form-control"
                                                    placeholder="Search" value="{{ request('search') }}">
                                                <span class="input-group-text border-0" id="search-addon">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <div id="data-table-container">
                                @include('admin.peta.partials.table', ['map' => $map])
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <h5 id="previewGardenArea">Peta Pratinjau </h5>
                    <div class="mb-3" id="map" style="height: 500px; width: 100%"></div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('styles')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <!-- jQuery & Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('js/maps.js') }}"></script>
@endpush
