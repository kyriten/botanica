<!-- partials/action-buttons.blade.php -->
<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#inputGardenModal">
    <i class="bi bi-plus-lg me-1"></i> Tambah Spot
</button>

{{-- <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#importListSpotModal">
    <i class="bi bi-cloud-upload-fill me-1"></i> Impor Daftar Spot
</button>

<a href="{{ route('map.export') }}" class="btn btn-success btn-sm">
    <i class="bi bi-cloud-download-fill me-1"></i> Ekspor Daftar Spot
</a> --}}

<button class="btn btn-danger btn-sm" id="deleteAllBtnMobile" disabled>
    <i class="bi bi-trash me-1"></i> Hapus Semua
</button>
