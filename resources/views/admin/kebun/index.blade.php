@extends('admin.app')

@section('garden')
    @include('components.garden.modalInputGarden')
    @include('components.garden.modalEditGarden')
    {{-- @include('components.garden.modalGambarGarden') --}}

    <main class="main" id="main">
        {{-- <div id="skeletonArea">
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
        </div> --}}

        <div id="titleArea" class="pagetitle">
            <div class="row fade-in">
                <div class="col-12">
                    <h1>Kelola Kebun Raya</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('garden.index') }}">Kebun Raya</a></li>
                            <li class="breadcrumb-item active">Daftar Kebun Raya</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section" id="contentArea">
            <div class="row fade-in">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div id="import-feedback" class="mt-2"></div>
                <div id="import-duplicates"></div>

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
                                            @include('admin.kebun.partials.action-buttons')
                                        </div>
                                    </div>

                                    <!-- Tombol (desktop - selalu tampil) -->
                                    <div class="d-none d-md-flex flex-wrap gap-2">
                                        @include('admin.kebun.partials.action-buttons-desktop')
                                    </div>
                                </div>

                                <!-- Search Bar -->
                                <div class="col-12 col-md-4">
                                    <form id="search-form" action="{{ route('garden.index') }}" method="GET">
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
                                @include('admin.kebun.partials.table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
