@extends('public.app')

@section('content')
    @if (request('nodata') === 'true')
        <div class="container py-3 py-md-5">
            <div class="row d-flex justify-content-between mb-3">
                <div class="col">
                    <a href="{{ url()->previous() }}" class="logo d-flex align-items-center mb-4 text-decoration-none">
                        <img src="{{ asset('images/logo.png') }}" alt="logo">
                        <span class="fs-4">{{ config('app.name') }}</span>
                    </a>
                </div>

                <div class="col p-0 text-end mb-3 pe-3">
                    <h3><strong>{{ $garden->name }}</strong> </h3>
                    <p class="plant-latin note-flag" style="font-size: 16px">Total <strong>{{ $count }}</strong>
                        tanaman
                    </p>
                </div>
            </div>

            <p class="text-center">
                Tidak ada data pada kebun raya ini.
            </p>
        </div>
    @endif
@endsection
