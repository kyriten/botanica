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
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-4 col-12 mb-2">
                        <div class="skeleton" style="height: 100px;"></div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="skeleton" style="height: 50px;"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-4">
                    <div class="skeleton" style="height: 300px;"></div>
                </div>
                <div class="col-12">
                    <div class="skeleton" style="height: 500px;"></div>
                </div>
            </div>
        </div>

        <div id="titleArea" class="pagetitle" style="display:none;">
            <div class="row fade-in">
                <div class="col-12">
                    <h1 id="pageTitle"></h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('map.index') }}">Peta</a></li>
                            <li class="breadcrumb-item active">Daftar Spot Tanaman</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section" id="contentArea" style="display:none;">
            <div class="row fade-in">
                <div id="alert-container"></div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Action Buttons -->
                            <div class="row g-3 my-3">
                                <div class="col-12 col-md-8">
                                    <!-- Toggle Button untuk Mobile -->
                                    <div class="d-block d-md-none mb-2">
                                        <button class="btn btn-outline-primary btn-sm" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#actionButtonsCollapse"
                                            aria-expanded="false" aria-controls="actionButtonsCollapse">
                                            <i class="bi bi-list me-1"></i> Menu Aksi
                                        </button>
                                    </div>

                                    <!-- Tombol (mobile - collapsible) -->
                                    <div class="collapse d-md-none" id="actionButtonsCollapse">
                                        <div class="d-flex flex-wrap gap-2 mt-2">
                                            @include('admin.peta.partials.action-buttons')
                                        </div>
                                    </div>

                                    <!-- Tombol (desktop - selalu tampil) -->
                                    <div class="d-none d-md-flex flex-wrap gap-2">
                                        @include('admin.peta.partials.action-buttons')
                                    </div>
                                </div>

                                <!-- Search Bar -->
                                <div class="col-12 col-md-4">
                                    <form id="search-form" action="{{ route('map.index') }}" method="GET">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control" placeholder="Search"
                                                value="{{ request('search') }}">
                                            <button class="btn btn-outline-secondary" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <!-- Tabel Data -->
                            <div id="data-table-container" class="table-responsive">
                                @include('admin.peta.partials.table')
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map Preview -->
                <div class="col-12 mt-4">
                    <h5 id="previewGardenArea">Peta Pratinjau</h5>
                    <div id="map" style="height: 400px; width: 100%;"></div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .btn {
            white-space: nowrap;
        }

        #map {
            width: 100%;
            height: 400px;
        }

        .input-group input {
            min-width: 0;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/maps.js') }}"></script>
@endpush
