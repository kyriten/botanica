@extends('public.app')

@section('content')
    <div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="text-center mb-4" style="max-width: 600px; width: 100%;">
            <h1 class="display-4 fw-bold text-botanica">{{ config('app.name') }}</h1>
            <p class="lead text-muted">Temukan informasi tanaman berdasarkan nama lokal atau nama latin</p>

            @include('public.partials.search-form', ['action' => route('public.search')])
        </div>

        <div id="loading-spinner" class="text-center my-4 d-none">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
@endsection
