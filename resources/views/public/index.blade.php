@extends('public.app')

@section('content')
    <div class="container d-flex flex-column justify-content-center align-items-center px-3" style="min-height: 100dvh;">
        <div class="text-center mb-4 w-100" style="max-width: 600px;">
            <div class="d-flex justify-content-center align-items-center mb-2">
                <!-- Logo untuk mobile -->
                <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40" class="d-block">
                <h1 class="fw-bold text-botanica fs-2 fs-md-3 fs-lg-4 mb-0">
                    {{ config('app.name') }}
                </h1>
            </div>

            <div class="alert alert-warning p-1">
                <p class="text-muted mb-0" style="font-size: 12px">
                Temukan informasi tanaman berdasarkan nama lokal, nama latin, jenis tanaman, lokasi tanaman, kingdom, sub
                kingdom, super divisi, divisi, kelas, sub kelas, ordo, famili, genus, atau spesies.
            </p>
            </div>

            @include('public.partials.search-form', ['action' => route('public.search')])
        </div>

        <div id="loading-spinner" class="text-center my-4 d-none">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
@endsection
