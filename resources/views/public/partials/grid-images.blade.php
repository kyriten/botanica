{{-- Grid Gambar 3x2 --}}
<div class="row g-3 mb-3">
    @foreach ($images as $index => $img)
        <div class="col-12 col-md-4">
            <div class="position-relative">
                <div
                    class="position-absolute top-0 start-50 translate-middle-x bg-botanica text-white px-3 py-1 rounded-bottom text-sm z-3">
                    {{ $img['label'] }}
                </div>
                <img src="{{ $img['src'] }}" class="img-fluid rounded w-100 cursor-pointer image-hover"
                    style="height: 200px; object-fit: cover;" alt="Gambar {{ $img['label'] }}" data-bs-toggle="modal"
                    data-bs-target="#imageModal" data-img="{{ $img['src'] }}" data-label="{{ $img['label'] }}">

            </div>
        </div>
    @endforeach
</div>

{{-- Modal Zoom Gambar --}}
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <img id="modal-image" src="" class="img-fluid rounded w-100" alt="Preview"
                    style="object-fit: contain;">
                <div class="text-center text-white fw-bold fs-5 mt-2" id="modal-label"></div>
            </div>
        </div>
    </div>
</div>
