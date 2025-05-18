@extends('public.app')

@section('content')
    <div class="container d-flex flex-column justify-content-center align-items-center px-3" style="min-height: 100vh;">
        <div class="text-center mb-4 w-100" style="max-width: 600px;">
            <h1 class="fw-bold text-botanica fs-2 fs-md-3 fs-lg-4">
                {{ config('app.name') }}
            </h1>
            <p class="text-muted fs-6 fs-md-5">
                Temukan informasi tanaman berdasarkan nama lokal atau nama latin
            </p>

            @include('public.partials.search-form', ['action' => route('public.search')])
        </div>

        <div id="loading-spinner" class="text-center my-4 d-none">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
@endsection
