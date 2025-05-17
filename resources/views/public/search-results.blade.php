@extends('public.app')

@section('title')
    Hasil untuk "{{ request('search') }}"
@endsection


@section('content')
    <div class="container py-5" style="max-width: 900px;">
        <div class="text-center">
            <h1 class="display-4 fw-bold text-botanica">{{ config('app.name') }}</h1>
            <p class="lead text-muted">Temukan informasi tanaman berdasarkan nama lokal atau nama latin</p>

            @include('public.partials.search-form', ['action' => route('public.search')])
        </div>

        {{-- Nav mirip Google Search --}}
        <div class="google-nav" role="tablist" aria-label="Search result tabs">
            <button class="active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" role="tab"
                aria-selected="true" aria-controls="all">All</button>
            <button id="image-tab" data-bs-toggle="tab" data-bs-target="#image" role="tab" aria-selected="false"
                aria-controls="image">Images</button>
        </div>

        <div id="loading-spinner" class="text-center my-4 d-none">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        @if ($total > 0)
            <p class="text-muted text-start">
                Ditemukan {{ $total }} hasil untuk <strong>"{{ $query }}"</strong>
            </p>
        @else
            <p class="text-muted text-center">
                Tidak ditemukan hasil untuk <strong>"{{ $query }}"</strong>
            </p>
        @endif

        <div class="tab-content" id="searchTabContent">
            {{-- Tab All --}}
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <div id="search-results">
                    @include('public.partials.plant-list', ['plants' => $plants])
                </div>
            </div>

            {{-- Tab Images --}}
            <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
                <div id="search-results">
                    @include('public.partials.plant-list-image', ['plants' => $plants])
                </div>
            </div>
        </div>
    </div>
@endsection
