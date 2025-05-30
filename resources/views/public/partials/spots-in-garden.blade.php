@extends('public.app')

@section('title')
    {{ $map->garden_name ?? 'Nama kebun tidak diketahui' }}
@endsection

@php
    $gardenName = $map->garden_name ?? null;
@endphp

@section('content')
    <!-- Tampilkan konten utama -->
    <div class="container py-3 py-md-5">
        <div class="row d-flex justify-content-between mb-3">
            <div class="col">
                <a href="{{ url()->previous() }}" class="logo d-flex align-items-center mb-4 text-decoration-none">
                    <img src="{{ asset('images/logo.png') }}" alt="logo">
                    <span class="fs-4">{{ config('app.name') }}</span>
                </a>
            </div>

            <div class="col p-0 text-end mb-3 pe-3">
                <h3><strong>{{ $map->garden_name }}</strong> </h3>
                <p class="plant-latin note-flag" style="font-size: 16px">Total <strong>{{ $count }}</strong>
                    tanaman
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                @if ($map->plant_lat && $map->plant_long)
                    <div id="map" style="height: 500px;" class="rounded mb-3"></div>
                @else
                    <div class="alert alert-warning text-center d-none d-md-block mx-4" role="alert">
                        Format titik koordinat tidak didukung. <br>
                        <strong>Format yang didukung:</strong> -7.797556, 112.736861 <br>
                        <strong>Format yang tidak didukung:</strong> 7°47'51.2"S 112°44'12.7"E
                    </div>
                @endif
            </div>

            <div class="col-md-5 overflow-x-auto">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-success" style="font-size: 16px">
                            <tr class="text-center">
                                <th scope="col">No.</th>
                                <th scope="col">Jenis Tanaman</th>
                                <th scope="col">Famili</th>
                                <th scope="col">Nama Lokal</th>
                                <th scope="col">Nama Latin</th>
                                <th scope="col">Kingdom</th>
                                <th scope="col">Sub Kingdom</th>
                                <th scope="col">Super Divisi</th>
                                <th scope="col">Divisi</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Sub Kelas</th>
                                <th scope="col">Ordo</th>
                                <th scope="col">Genus</th>
                                <th scope="col">Spesies</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Latitude</th>
                                <th scope="col">Longitude</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 16px">
                            @forelse ($maps as $index => $map)
                                <tr onclick="window.location='{{ route('plant.show', $map->id) }}';"
                                    style="cursor: pointer;">
                                    <td>
                                        <a href="{{ route('plant.show', $map->id) }}"
                                            class="text-decoration-none text-dark">
                                            {{ $loop->iteration + ($maps->firstItem() - 1) }}
                                        </a>
                                    </td>
                                    <td>{{ $map->category ?? '-' }}</td>
                                    <td>{{ $map->famili ?? '-' }}</td>
                                    <td>{{ $map->local ?? '-' }}</td>
                                    <td><i>{{ $map->latin ?? '-' }}</i></td>
                                    <td>{{ $map->kingdom ?? '-' }}</td>
                                    <td>{{ $map->sub_kingdom ?? '-' }}</td>
                                    <td>{{ $map->super_division ?? '-' }}</td>
                                    <td>{{ $map->division ?? '-' }}</td>
                                    <td>{{ $map->class ?? '-' }}</td>
                                    <td>{{ $map->sub_class ?? '-' }}</td>
                                    <td>{{ $map->ordo ?? '-' }}</td>
                                    <td>{{ $map->genus ?? '-' }}</td>
                                    <td>{{ $map->species ?? '-' }}</td>
                                    <td>
                                        <div class="description-container" style="max-width: 250px;">
                                            <span class="short-description d-block text-truncate" style="max-width: 250px;">
                                                {{ Str::limit(strip_tags($map->description), 100) }}
                                            </span>

                                            <div class="full-description d-none mt-2">
                                                {!! $map->description !!}
                                            </div>

                                            @if (strlen(strip_tags($map->description)) > 100)
                                                <a href="#" class="toggle-description text-primary"
                                                    data-id="{{ $map->id }}">Lihat Selengkapnya</a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $map->plant_lat ?? '-' }}</td>
                                    <td>{{ $map->plant_long ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada data spot ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                {{-- PAGINATION --}}
                @if ($maps->hasPages())
                    <nav aria-label="Pagination">
                        <ul class="pagination justify-content-center pagination-circle mt-2">
                            {{-- Previous --}}
                            @if ($maps->onFirstPage())
                                <li class="page-item disabled"><span class="page-link"><i
                                            class="bi bi-chevron-double-left"></i></span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $maps->previousPageUrl() }}"><i
                                            class="bi bi-chevron-double-left"></i></a></li>
                            @endif

                            @php
                                $currentPage = $maps->currentPage();
                                $lastPage = $maps->lastPage();
                                $start = max($currentPage - 1, 1);
                                $end = min($currentPage + 1, $lastPage);
                            @endphp

                            @if ($start > 1)
                                <li class="page-item"><a class="page-link" href="{{ $maps->url(1) }}">1</a></li>
                                @if ($start > 2)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                            @endif

                            @for ($i = $start; $i <= $end; $i++)
                                @if ($i == $currentPage)
                                    <li class="page-item active"><span class="page-link">{{ $i }}</span>
                                    </li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $maps->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endif
                            @endfor

                            @if ($end < $lastPage)
                                @if ($end < $lastPage - 1)
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                                <li class="page-item"><a class="page-link"
                                        href="{{ $maps->url($lastPage) }}">{{ $lastPage }}</a></li>
                            @endif

                            {{-- Next --}}
                            @if ($maps->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $maps->nextPageUrl() }}"><i
                                            class="bi bi-chevron-double-right"></i></a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link"><i
                                            class="bi bi-chevron-double-right"></i></span></li>
                            @endif
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </div>

    <script>
        var map = L.map('map').setView([
            {{ $maps->first()->plant_lat ?? -6.597146 }},
            {{ $maps->first()->plant_long ?? 106.806039 }}
        ], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        @foreach ($maps as $spot)
            @if (is_numeric($spot->plant_lat) && is_numeric($spot->plant_long))
                L.marker([{{ $spot->plant_lat }}, {{ $spot->plant_long }}]).addTo(map)
                    .bindPopup(`<strong>{{ e($spot->local) }}</strong><br><i>{{ e($spot->latin) }}</i>`);
            @endif
        @endforeach
    </script>
@endsection
