@extends('public.app')

@section('title')
    Daftar Kebun Raya
@endsection

@section('content')
    <div class="container py-3 py-md-5">
        <div class="row d-flex justify-content-between mb-3">
            <div class="col">
                <a href="/" class="logo d-flex align-items-center mb-4 text-decoration-none">
                    <img src="{{ asset('images/logo.png') }}" alt="logo">
                    <span class="fs-4">{{ config('app.name') }}</span>
                </a>
            </div>

            <div class="col p-0 text-end mb-3 pe-3">
                <h3><strong>Daftar Kebun Raya</strong> </h3>
                <p class="plant-latin note-flag" style="font-size: 16px">Total <strong>{{ $count }}</strong> kebun
                </p>
            </div>
        </div>

        <div class="list-group">
            @foreach ($gardens as $garden)
                <a href="{{  route('garden.showMaps', ['slug' => $garden->slug]) }}" class="list-group-item list-group-item-action py-3 mb-2 mt-2 border-1 rounded"
                    style="border-top: 0; border-bottom: 0;">
                    <h5 class="mb-1 text-botanica fw-bold">{{ $garden->name }}</h5>
                </a>
            @endforeach
        </div>
    </div>
@endsection
