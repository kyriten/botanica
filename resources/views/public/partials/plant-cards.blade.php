@php
    $hasSearch = request()->has('search') && request('search') !== '';
@endphp

@if ($plants->count())
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($plants as $plant)
            <div class="col">
                <a href="{{ route('plant.show', $plant->id) }}" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                        <div class="ratio ratio-4x3">
                            <img src="{{ $plant->plant_image ? asset('storage/' . $plant->plant_image) : asset('images/no-image.png') }}"
                                class="img-fluid object-fit-cover" alt="Gambar {{ $plant->local }}"
                                style="object-fit: cover;">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title text-primary mb-1">{{ $plant->local }}</h5>
                            <p class="card-subtitle text-muted mb-2"><em>{{ $plant->latin }}</em></p>
                            <p class="card-subtitle text-muted mb-2 text-truncate" style="max-width: 100%;">
                                <em>{{ $plant->description }}</em>
                            </p>
                            <p class="card-text small mb-0">
                                <i class="bi bi-geo-alt-fill me-1 text-danger"></i>
                                <strong>{{ $plant->garden_name ?? 'Tidak diketahui' }}</strong>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center text-muted py-5">
        <i class="bi bi-search display-4 d-block mb-3"></i>
        <p class="fs-5">
            {{ $hasSearch ? 'Tidak ditemukan hasil yang cocok.' : 'Cari taksonomi tanaman' }}
        </p>
    </div>
@endif
