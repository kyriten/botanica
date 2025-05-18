@extends('public.app')

@section('content')
    <div class="container py-3 py-md-5">
        <a href="{{ url()->previous() }}" class="btn btn-light mb-4">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="card shadow-sm">
            <div class="row g-0 d-none d-md-flex">
                {{-- Desktop mode: info kiri, carousel kanan, peta di bawah --}}
                <div class="col-md-6 order-md-1 px-4">
                    {{-- Detail tanaman --}}
                    <ul class="list-unstyled mt-3">
                        <li><strong>Persebaran:</strong> {{ $plant->city_name ?? '-' }}, {{ $plant->province_name ?? '-' }}
                        </li>
                        <li><strong>Lokasi:</strong> {{ $plant->garden_name ?? '-' }}</li>
                        <li><strong>Kingdom:</strong> {{ $plant->kingdom }}</li>
                        <li><strong>Sub Kingdom:</strong> {{ $plant->sub_kingdom }}</li>
                        <li><strong>Super Division:</strong> {{ $plant->super_division }}</li>
                        <li><strong>Division:</strong> {{ $plant->division }}</li>
                        <li><strong>Kelas:</strong> {{ $plant->class }}</li>
                        <li><strong>Sub Kelas:</strong> {{ $plant->sub_class }}</li>
                        <li><strong>Ordo:</strong> {{ $plant->ordo }}</li>
                        <li><strong>Famili:</strong> {{ $plant->famili }}</li>
                        <li><strong>Genus:</strong> {{ $plant->genus }}</li>
                        <li><strong>Spesies:</strong> {{ $plant->species }}</li>
                        <li><strong>Deskripsi:</strong> {{ $plant->description }}</li>
                    </ul>
                </div>
                <div class="col-md-6 order-md-2 px-3 px-md-4">
                    {{-- Carousel --}}
                    <div id="plantImageCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                        <div class="carousel-inner rounded position-relative">
                            @php
                                $images = [
                                    [
                                        'src' => $plant->plant_image
                                            ? asset('storage/' . $plant->plant_image)
                                            : asset('images/no-image.png'),
                                        'label' => 'Tanaman',
                                    ],
                                    [
                                        'src' => $plant->leaf_image
                                            ? asset('storage/' . $plant->leaf_image)
                                            : asset('images/no-image.png'),
                                        'label' => 'Daun',
                                    ],
                                    [
                                        'src' => $plant->stem_image
                                            ? asset('storage/' . $plant->stem_image)
                                            : asset('images/no-image.png'),
                                        'label' => 'Batang',
                                    ],
                                ];
                            @endphp
                            @foreach ($images as $index => $img)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="position-relative text-center">
                                        <div
                                            class="position-absolute top-0 start-50 translate-middle-x bg-primary text-white px-3 py-1 rounded-bottom text-sm z-3">
                                            {{ $img['label'] }}
                                        </div>
                                        <img src="{{ $img['src'] }}" class="d-block w-100 rounded"
                                            style="height: 400px; object-fit: cover;" alt="Gambar {{ $img['label'] }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#plantImageCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#plantImageCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Mobile mode: carousel di atas, tab Detil & Lokasi --}}
            <div class="d-md-none px-3 px-md-4">
                {{-- Carousel --}}
                <div id="plantImageCarouselMobile" class="carousel slide mb-3" data-bs-ride="carousel">
                    <div class="carousel-inner rounded position-relative">
                        @foreach ($images as $index => $img)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="position-relative text-center">
                                    <div
                                        class="position-absolute top-0 start-50 translate-middle-x bg-primary text-white px-3 py-1 rounded-bottom text-sm z-3">
                                        {{ $img['label'] }}
                                    </div>
                                    <img src="{{ $img['src'] }}" class="d-block w-100 rounded"
                                        style="height: 400px; object-fit: cover;" alt="Gambar {{ $img['label'] }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#plantImageCarouselMobile"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#plantImageCarouselMobile"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>

                {{-- Tabs --}}
                <ul class="nav nav-tabs" id="plantTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-botanica active" id="detail-tab" data-bs-toggle="tab"
                            data-bs-target="#detail-tab-pane" type="button" role="tab" aria-controls="detail-tab-pane"
                            aria-selected="true">Detil</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-botanica" id="location-tab" data-bs-toggle="tab"
                            data-bs-target="#location-tab-pane" type="button" role="tab"
                            aria-controls="location-tab-pane" aria-selected="false">Lokasi</button>
                    </li>
                </ul>


                {{-- Tab content --}}
                <div class="tab-content mt-3" id="plantTabContent">
                    <div class="tab-pane fade show active" id="detail-tab-pane" role="tabpanel"
                        aria-labelledby="detail-tab">
                        {{-- Detail tanaman --}}
                        <ul class="list-unstyled">
                            <li><strong>Persebaran:</strong> {{ $plant->city_name ?? '-' }},
                                {{ $plant->province_name ?? '-' }}</li>
                            <li><strong>Lokasi:</strong> {{ $plant->garden_name ?? '-' }}</li>
                            <li><strong>Kingdom:</strong> {{ $plant->kingdom }}</li>
                            <li><strong>Sub Kingdom:</strong> {{ $plant->sub_kingdom }}</li>
                            <li><strong>Super Division:</strong> {{ $plant->super_division }}</li>
                            <li><strong>Division:</strong> {{ $plant->division }}</li>
                            <li><strong>Kelas:</strong> {{ $plant->class }}</li>
                            <li><strong>Sub Kelas:</strong> {{ $plant->sub_class }}</li>
                            <li><strong>Ordo:</strong> {{ $plant->ordo }}</li>
                            <li><strong>Famili:</strong> {{ $plant->famili }}</li>
                            <li><strong>Genus:</strong> {{ $plant->genus }}</li>
                            <li><strong>Spesies:</strong> {{ $plant->species }}</li>
                            <li><strong>Deskripsi:</strong> {{ $plant->description }}</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="location-tab-pane" role="tabpanel" aria-labelledby="location-tab">
                        @if (!$plant->plant_lat || !$plant->plant_long)
                            <div class="alert alert-warning text-center" role="alert">
                                Koordinat tidak tersedia.
                            </div>
                        @else
                            <div id="plant-map" style="height: 400px;" class="rounded"></div>
                        @endif
                    </div>

                </div>
            </div>

            {{-- Peta desktop --}}
            @if ($plant->plant_lat && $plant->plant_long)
                <div id="plant-map-desktop" style="height: 400px;" class="rounded d-none d-md-block"></div>
            @else
                <div class="alert alert-warning text-center d-none d-md-block mx-4" role="alert">
                    Data tidak tersedia.
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scriptPlantShow')
    <script>
        window.plantData = {
            lat: @json($plant->plant_lat),
            lng: @json($plant->plant_long),
            name: @json($plant->local),
        };
    </script>
@endpush
