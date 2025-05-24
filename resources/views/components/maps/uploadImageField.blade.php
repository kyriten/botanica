<div class="image-wrapper">
    <div class="position-relative mb-4 text-center">
        <div class="label-image">{{ $label }}</div>

        <img
            id="{{ $imgId }}"
            src="{{ $imgSrc ? asset('storage/' . $imgSrc) : 'http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg' }}"
            alt="image preview"
            class="img-preview"
        />
    </div>

    <div class="mb-2 text-center text-danger">
        @error($imgName)
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="d-flex justify-content-center">
        <div class="btn btn-botanica btn-rounded mb-3">
            <label class="form-label text-white mb-0" for="{{ $inputId }}">Pilih gambar</label>
            <input
                class="form-control d-none @error($imgName) is-invalid @enderror"
                id="{{ $inputId }}"
                name="{{ $imgName }}"
                type="file"
                accept="image/png, image/jpeg, image/jpg"
                onchange="showPreview(event, '{{ $imgId }}');"
            >
        </div>
    </div>
</div>
