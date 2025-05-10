@extends('public.app')

@section('content')
    <div class="container py-5">
        <a href="{{ url()->previous() }}" class="btn btn-light mb-4">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="card shadow-sm">
            <div class="row g-0">


                <div class="col-md-6">
                    <div class="card-body">
                        <h2 class="card-title text-primary">{{ $plant->local }}</h2>
                        <h5 class="text-muted fst-italic">{{ $plant->latin }}</h5>

                        <ul class="list-unstyled mt-4">
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

                        <div class="mt-3">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-left-circle"></i> Kembali ke Pencarian
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-body">
                        <div id="plantImageCarousel" class="carousel slide" data-bs-ride="carousel">
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
                                            {{-- Label --}}
                                            <div
                                                class="position-absolute top-0 start-50 translate-middle-x bg-primary text-white px-3 py-1 rounded-bottom text-sm z-3">
                                                {{ $img['label'] }}
                                            </div>

                                            {{-- Gambar --}}
                                            <img src="{{ $img['src'] }}" class="d-block w-100 rounded"
                                                style="height: 400px; object-fit: cover;" alt="Gambar {{ $img['label'] }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Tombol navigasi --}}
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


            </div>
            <div class="col-md-12">
                <div class="card-body">
                    <div id="plant-map" style="height: 400px;" class="rounded mt-3"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('stylesPlant')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css">

    <style>
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            background-size: 60% 60%;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 15%;
        }
    </style>
@endpush

@push('scriptsPlant')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lat = {{ $plant->plant_lat ?? 'null' }};
            const lng = {{ $plant->plant_long ?? 'null' }};

            if (lat && lng) {
                const map = L.map('plant-map').setView([lat, lng], 16);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                L.marker([lat, lng]).addTo(map)
                    .bindPopup("{{ $plant->local }}")
                    .openPopup();
            } else {
                document.getElementById('plant-map').innerHTML =
                    '<p class="text-muted text-center">Koordinat tidak tersedia.</p>';
            }
        });
    </script>
@endpush
