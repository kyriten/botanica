<div class="list-group">
    @foreach ($plants as $plant)
        <a href="{{ route('plant.show', $plant->id) }}" class="list-group-item list-group-item-action py-3">
            <h5 class="mb-1 text-primary">{{ $plant->local }}</h5>
            <small class="text-muted fst-italic">{{ $plant->latin }}</small>
            <p class="mb-1 text-truncate">{{ $plant->description }}</p>
            <small class="text-danger">
                <i class="bi bi-geo-alt-fill me-1"></i>
                {{ $plant->garden_name ?? 'Tidak diketahui' }}
            </small>
        </a>
    @endforeach
</div>
