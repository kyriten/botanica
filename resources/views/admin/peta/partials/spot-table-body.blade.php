@forelse ($map as $item)
    <tr id="spot-row-{{ $item->id }}">
        <td>
            <input type="checkbox" class="spot-checkbox" data-id="{{ $item->id }}">
        </td>
        <td>{{ $loop->iteration + ($map->firstItem() - 1) }}</td>
        <td>{{ $item->category }}</td>
        <td>{{ $item->famili }}</td>
        <td>{{ $item->local }}</td>
        <td>{{ $item->latin }}</td>
        <td>{{ $item->kingdom }}</td>
        <td>{{ $item->sub_kingdom }}</td>
        <td>{{ $item->super_division }}</td>
        <td>{{ $item->division }}</td>
        <td>{{ $item->class }}</td>
        <td>{{ $item->sub_class }}</td>
        <td>{{ $item->ordo }}</td>
        <td>{{ $item->genus }}</td>
        <td>{{ $item->species }}</td>
        <td>
            <div class="description-container" style="max-width: 250px;">
                {{-- Deskripsi singkat --}}
                <span class="short-description d-block text-truncate" style="max-width: 250px;">
                    {{ Str::limit(strip_tags($item->description), 100) }}
                </span>

                {{-- Deskripsi lengkap (berisi HTML, awalnya tersembunyi) --}}
                <div class="full-description d-none mt-2">
                    {!! $item->description !!}
                </div>

                {{-- Tombol toggle --}}
                @if (strlen(strip_tags($item->description)) > 100)
                    <a href="#" class="toggle-description text-primary" data-id="{{ $item->id }}">Lihat
                        Selengkapnya</a>
                @endif
            </div>
        </td>

        <td>
            @if ($item->plant_image)
                <img src="{{ asset('storage/' . $item->plant_image) }}" alt="Foto Tanaman"
                    style="max-width: 100px; height: auto;">
            @else
                <span>Foto belum diunggah</span>
            @endif
        </td>

        <td>
            @if ($item->stem_image)
                <img src="{{ asset('storage/' . $item->stem_image) }}" alt="Foto Batang"
                    style="max-width: 100px; height: auto;">
            @else
                <span>Foto belum diunggah</span>
            @endif
        </td>

        <td>
            @if ($item->leaf_image)
                <img src="{{ asset('storage/' . $item->leaf_image) }}" alt="Foto Daun"
                    style="max-width: 100px; height: auto;">
            @else
                <span>Foto belum diunggah</span>
            @endif
        </td>

        <td>
            @if ($item->flower_image)
                <img src="{{ asset('storage/' . $item->flower_image) }}" alt="Foto Bunga"
                    style="max-width: 100px; height: auto;">
            @else
                <span>Foto belum diunggah</span>
            @endif
        </td>

        <td>
            @if ($item->fruit_image)
                <img src="{{ asset('storage/' . $item->fruit_image) }}" alt="Foto Buah"
                    style="max-width: 100px; height: auto;">
            @else
                <span>Foto belum diunggah</span>
            @endif
        </td>

        <td>
            @if ($item->another_image)
                <img src="{{ asset('storage/' . $item->another_image) }}" alt="Foto Lainnya"
                    style="max-width: 100px; height: auto;">
            @else
                <span>Foto belum diunggah</span>
            @endif
        </td>

        <td>{{ $item->garden_name }}</td>
        <td>
            @if ($item->city_name || $item->province_name)
                {{ $item->city_name ?? '-' }}, {{ $item->province_name ?? '-' }}
            @else
                -
            @endif
        </td>
        <td>{{ $item->plant_lat }}</td>
        <td>{{ $item->plant_long }}</td>
        <td>
            <div class="d-flex gap-3">
                <a href="#" class="btn btn-warning btn-edit-spot" data-id="{{ $item->id }}"
                    data-bs-toggle="modal" data-bs-target="#editSpotModal">
                    <i class="bi bi-pencil"></i>
                </a>

                <form action="{{ route('map.destroy', $item->id) }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Apakah kamu yakin menghapus data?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="27" class="text-center">Tidak ada data</td>
    </tr>
@endforelse
