<div class="list-group">
    @foreach ($plants as $plant)
        <a href="{{ route('plant.show', $plant->id) }}"
            class="list-group-item list-group-item-action py-3 border-0">
            <h5 class="mb-1 text-botanica fw-bold">{{ $plant->local }}</h5>
            <div class="d-flex align-items-center justify-content-between">
                <small class="text-muted fst-italic">{{ $plant->latin }}</small>
                <small class="text-danger">
                    <i class="bi bi-geo-alt-fill me-1"></i>
                    {{ $plant->garden_name ?? 'Tidak diketahui' }}
                </small>
            </div>
        </a>
    @endforeach
</div>
