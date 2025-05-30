@extends('public.app')

@section('content')
    <div class="container d-flex flex-column" style="min-height: 100dvh;">

        <div class="d-flex flex-column justify-content-center align-items-center flex-grow-1 px-3">
            <div class="row w-100">
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" height="80" class="d-block logo-botanica-mobile">

                    <h1 class="fw-bold text-botanica fs-2 fs-md-3 fs-desktop mb-0 ms-sm-1 title-botanica-mobile">
                        {{ config('app.name') }}
                    </h1>
                </div>
            </div>

            <div class="row w-100">
                @include('public.partials.search-form', ['action' => route('public.search')])
            </div>
        </div>

        <div class="text-center mt-auto pb-3 px-3" style="max-width: 600px; margin: 0 auto;">
            <p class="text-muted mb-0" style="font-size: 12px;">
                Temukan informasi tanaman berdasarkan nama lokal, nama latin, jenis tanaman, lokasi tanaman, kingdom,
                sub kingdom, super divisi, divisi, kelas, sub kelas, ordo, famili, genus, atau spesies.
            </p>
        </div>
    </div>
@endsection
