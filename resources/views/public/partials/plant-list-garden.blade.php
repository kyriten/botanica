<div class="list-group">
    @foreach ($gardens as $garden)
        <a href="#"
            class="list-group-item list-group-item-action py-3 mb-2 mt-2 border-1 rounded"
            style="border-top: 0; border-bottom: 0;">
            <h5 class="mb-1 text-botanica fw-bold">{{ $garden->name }}</h5>
        </a>
    @endforeach
</div>

