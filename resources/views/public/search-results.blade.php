@extends('public.app')

@section('title')
    Hasil untuk {{ request('search') }}
@endsection

@php
    $activeTab = request('tab', 'all');
    $hasCategory = request()->filled('category');
    $hasGarden = request()->filled('garden');
    $hasSearchTerm = !empty($query);
@endphp

@section('content')
    <div class="container py-4 py-md-3" style="max-width: 900px;">
        <div class="search-header-wrapper">
            <div
                class="search-header d-flex flex-column flex-sm-row align-items-center justify-content-center text-center text-sm-start">
                <!-- Logo dan Judul -->
                <a href="/" class="text-decoration-none mb-sm-0 me-sm-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <!-- Logo -->
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="42" class="d-block">

                        <!-- Judul -->
                        <h1 class="fw-bold text-botanica m-0 ms-2 d-block d-sm-block" style="font-size:42px">
                            {{ config('app.name') }}
                        </h1>
                    </div>
                </a>

                <!-- Search Bar -->
                <div class="search-bar w-100 w-sm-auto">
                    @include('public.partials.search-form', ['action' => route('public.search')])
                </div>
            </div>

            {{-- Nav mirip Google Search --}}
            <div class="google-nav" role="tablist" aria-label="Search result tabs">
                <button class="active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" role="tab"
                    aria-selected="true" aria-controls="all">Semua</button>
                <button id="image-tab" data-bs-toggle="tab" data-bs-target="#image" role="tab" aria-selected="false"
                    aria-controls="image">Gambar</button>
                <button id="garden-tab" data-bs-toggle="tab" data-bs-target="#garden" role="tab" aria-selected="false"
                    aria-controls="garden">Kebun Raya</button>
            </div>
        </div>

        <div id="loading-spinner" class="text-center my-4 d-none">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        @if ($total > 0)
            <p class="text-muted text-start mt-3" style="font-size: 12px">
                Ditemukan {{ $total }} hasil
                @if ($hasSearchTerm || $hasCategory)
                    untuk
                    @if ($hasSearchTerm)
                        <strong>{{ $query ? $query : 'semua' }}</strong>
                    @endif
                    @if ($hasSearchTerm && $hasCategory)
                        &mdash;
                    @endif
                    @if ($hasCategory)
                        kategori <strong>{{ request('category') }}</strong>
                    @endif
                @endif
            </p>
        @elseif($total === 0 && ($hasSearchTerm || $hasCategory))
            <p class="text-muted text-center mt-3" style="font-size: 12px">
                Tidak ditemukan hasil
                @if ($hasSearchTerm || $hasCategory)
                    untuk
                    @if ($hasSearchTerm)
                        <strong>{{ $query }}</strong>
                    @endif
                    @if ($hasSearchTerm && $hasCategory)
                        &mdash;
                    @endif
                    @if ($hasCategory)
                        kategori <strong>{{ request('category') }}</strong>
                    @endif
                @endif
            </p>
        @else
            <p class="text-muted text-center mt-3" style="font-size: 12px">
                Tidak ada data
            </p>
        @endif

        <div class="tab-content" id="searchTabContent">
            {{-- Tab All --}}
            <div class="tab-pane fade {{ $activeTab === 'all' ? 'show active' : '' }}" id="all" role="tabpanel"
                aria-labelledby="all-tab">
                <div id="search-results-all">
                    @include('public.partials.plant-list', ['plants' => $plants])
                </div>
            </div>

            {{-- Tab Images --}}
            <div class="tab-pane fade {{ $activeTab === 'image' ? 'show active' : '' }}" id="image" role="tabpanel"
                aria-labelledby="image-tab">
                <div id="search-results-image">
                    @include('public.partials.plant-list-image', ['plants' => $plants])
                </div>
            </div>

            {{-- Tab Garden --}}
            <div class="tab-pane fade {{ $activeTab === 'garden' ? 'show active' : '' }}" id="garden" role="tabpanel"
                aria-labelledby="garden-tab">
                <div id="search-results-garden">
                    @include('public.partials.plant-list-garden', ['plants' => $plants])
                </div>
            </div>
        </div>
    </div>
@endsection
