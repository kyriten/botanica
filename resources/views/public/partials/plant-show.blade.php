@extends('public.app')

@section('content')
    <div class="container py-3 py-md-5">
        <div class="row d-flex justify-content-between mb-3">
            <div class="col">
                <a href="{{ url()->previous() }}" class="btn btn-light mb-4">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="col p-0 text-end mb-3 pe-3">
                <h3><strong>{{ $plant->local }}</strong> </h3>
                <i class="plant-latin" style="font-size: 16px">{{ $plant->latin }}</i>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="row g-0 d-none d-md-flex">
                {{-- Desktop mode: info kiri, carousel kanan, peta di bawah --}}
                <div class="col-md-6 order-md-1 px-4">
                    {{-- Detail tanaman --}}
                    <table class="table table-sm table-borderless mt-3 w-auto">
                        <tbody>
                            <tr>
                                <th scope="row">Lokasi</th>
                                <td>{{ $plant->garden_name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Kingdom</th>
                                <td>{{ $plant->kingdom }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Sub Kingdom</th>
                                <td>{{ $plant->sub_kingdom }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Super Division</th>
                                <td>{{ $plant->super_division }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Division</th>
                                <td>{{ $plant->division }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Kelas</th>
                                <td>{{ $plant->class }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Sub Kelas</th>
                                <td>{{ $plant->sub_class }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Ordo</th>
                                <td>{{ $plant->ordo }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Famili</th>
                                <td>{{ $plant->famili }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Genus</th>
                                <td>{{ $plant->genus }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Spesies</th>
                                <td>{{ $plant->species }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Persebaran</th>
                                <td>
                                    @if(!empty($plant->city_name) || !empty($plant->province_name))
                                        {{ $plant->city_name ?? '' }}{{ $plant->city_name && $plant->province_name ? ', ' : '' }}{{ $plant->province_name ?? '' }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Deskripsi</th>
                                <td>{{ $plant->description }}</td>
                            </tr>
                        </tbody>
                    </table>
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
                                    [
                                        'src' => $plant->flower_image
                                            ? asset('storage/' . $plant->flower_image)
                                            : asset('images/no-image.png'),
                                        'label' => 'Bunga',
                                    ],
                                    [
                                        'src' => $plant->fruit_image
                                            ? asset('storage/' . $plant->fruit_image)
                                            : asset('images/no-image.png'),
                                        'label' => 'Buah',
                                    ],
                                    [
                                        'src' => $plant->another_image
                                            ? asset('storage/' . $plant->another_image)
                                            : asset('images/no-image.png'),
                                        'label' => 'Lain-lain',
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
                        <table class="table table-sm table-borderless mt-3 w-auto">
                        <tbody>
                            <tr>
                                <th scope="row">Lokasi</th>
                                <td>{{ $plant->garden_name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Kingdom</th>
                                <td>{{ $plant->kingdom }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Sub Kingdom</th>
                                <td>{{ $plant->sub_kingdom }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Super Division</th>
                                <td>{{ $plant->super_division }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Division</th>
                                <td>{{ $plant->division }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Kelas</th>
                                <td>{{ $plant->class }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Sub Kelas</th>
                                <td>{{ $plant->sub_class }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Ordo</th>
                                <td>{{ $plant->ordo }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Famili</th>
                                <td>{{ $plant->famili }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Genus</th>
                                <td>{{ $plant->genus }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Spesies</th>
                                <td>{{ $plant->species }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Persebaran</th>
                                <td>
                                    @if(!empty($plant->city_name) || !empty($plant->province_name))
                                        {{ $plant->city_name ?? '' }}{{ $plant->city_name && $plant->province_name ? ', ' : '' }}{{ $plant->province_name ?? '' }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Deskripsi</th>
                                <td>{{ $plant->description }}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <div class="tab-pane fade" id="location-tab-pane" role="tabpanel" aria-labelledby="location-tab">
                        @if (!$plant->plant_lat || !$plant->plant_long)
                            <div class="alert alert-warning text-center" role="alert">
                                Koordinat tidak tersedia.
                            </div>
                        @else
                            <div id="plant-map" style="height: 400px;" class="rounded d-block d-md-none"></div>
                            <div id="distance-display" class="text-center mt-2 text-muted"></div>
                        @endif
                    </div>

                </div>
            </div>

            {{-- Peta desktop --}}
            @if ($plant->plant_lat && $plant->plant_long)
                <div id="plant-map-desktop" style="height: 400px;" class="rounded d-none d-md-block"></div>
                <div id="distance-display" class="text-center mt-2 text-muted"></div>
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
            lat: {{ $plant->plant_lat ?? 'null' }},
            lng: {{ $plant->plant_long ?? 'null' }},
            local: @json($plant->local),
            latin: @json($plant->latin)
        };
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const plant = window.plantData || {};
        let mapMobile, mapDesktop;
        let mapMobileInitialized = false;
        let mapDesktopInitialized = false;

        function isValidCoordinate(value) {
            return typeof value === "number" && !isNaN(value);
        }

        function getPopupContent() {
            const local = plant.local || "Tanaman";
            const latin = plant.latin || "";

            return `<div>
                <strong>${local}</strong><br>
                <em>${latin}</em>
            </div>`;
        }

        function initMapMobile() {
            if (mapMobileInitialized) return;
            mapMobileInitialized = true;

            const lat = plant.lat;
            const lng = plant.lng;

            const container = document.getElementById("plant-map");
            if (!container) return;

            if (isValidCoordinate(lat) && isValidCoordinate(lng)) {
                mapMobile = L.map(container).setView([lat, lng], 16);

                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    attribution: "© OpenStreetMap contributors",
                }).addTo(mapMobile);

                L.marker([lat, lng])
                    .addTo(mapMobile)
                    .bindPopup(getPopupContent())
                    .openPopup();
            } else {
                container.innerHTML =
                    '<p class="text-muted text-center">Koordinat tidak tersedia.</p>';
            }
        }

        function initMapDesktop() {
            if (mapDesktopInitialized) return;
            mapDesktopInitialized = true;

            const lat = plant.lat;
            const lng = plant.lng;

            const container = document.getElementById("plant-map-desktop");
            if (!container) return;

            if (isValidCoordinate(lat) && isValidCoordinate(lng)) {
                mapDesktop = L.map(container).setView([lat, lng], 16);

                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    attribution: "© OpenStreetMap contributors",
                }).addTo(mapDesktop);

                L.marker([lat, lng])
                    .addTo(mapDesktop)
                    .bindPopup(getPopupContent())
                    .openPopup();
            } else {
                container.innerHTML =
                    '<p class="text-muted text-center">Koordinat tidak tersedia.</p>';
            }
        }

        function initMapsByViewport() {
            if (window.innerWidth >= 768) {
                initMapDesktop();
            } else {
                if (
                    document
                        .getElementById("location-tab-pane")
                        ?.classList.contains("show")
                ) {
                    initMapMobile();
                }

                const locationTabBtn = document.getElementById("location-tab");
                if (locationTabBtn) {
                    locationTabBtn.addEventListener("shown.bs.tab", function () {
                        initMapMobile();
                    });
                }
            }
        }

        initMapsByViewport();
        window.addEventListener("resize", function () {
            initMapsByViewport();
        });
    });
    </script>

@endpush
