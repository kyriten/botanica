<div class="table-responsive">
    <table class="table" id="spot-table">
        <thead>
            <tr>
                <th>
                    <input type="checkbox" id="selectAllCheckbox" />
                </th>
                <th scope="col">#</th>
                <th scope="col">Nama Tumbuhan</th>
                <th scope="col">Kebun Raya</th>
                <th scope="col">Persebaran</th>
                <th scope="col">Latitude</th>
                <th scope="col">Longitude</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($map as $item)
                <tr id="spot-row-{{ $item->id }}">
                    <td>
                        <input type="checkbox" class="spot-checkbox" data-id="{{ $item->id }}">
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->local }}</td>
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
                                <button class="btn btn-danger"
                                    onclick="return confirm('Apakah kamu yakin menghapus data?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No records available</td>
                </tr>
            @endforelse

        </tbody>
        <!-- Bagian untuk menampilkan tautan paginate -->
    </table>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item">{{ $map->links() }}</li>
        </ul>
    </nav>
</div>
