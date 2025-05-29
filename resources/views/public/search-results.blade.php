@extends('public.app')

@section('title')
    Hasil untuk {{ request('search') }}
@endsection

@php
    $activeTab = request('tab', 'all');
    $hasCategory = request()->filled('category');
    $hasSearchTerm = !empty($query);
@endphp

@section('content')
    <div class="container py-4 py-md-3" style="max-width: 900px;">
        <div class="search-header-wrapper">
            <div class="search-header d-flex align-items-center justify-content-center">
                <a href="/" class="text-decoration-none flex-shrink-0">
                    <div class="d-flex justify-content-center align-items-center mb-2">
                        <!-- Logo untuk mobile -->
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40" class="d-block d-sm-block">
    
                        <!-- Judul untuk desktop -->
                        <h1 class="fw-bold text-botanica d-none d-sm-block m-0 ms-sm-1">
                            {{ config('app.name') }}
                        </h1>
                    </div>
                </a>

                <div class="search-bar flex-grow-1 w-100 w-sm-auto">
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
