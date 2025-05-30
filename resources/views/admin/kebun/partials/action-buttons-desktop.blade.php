<!-- partials/action-buttons.blade.php -->
<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#inputGardenModal">
    <i class="bi bi-plus-lg me-1"></i> Tambah Spot
</button>

{{-- <div class="d-flex justify-content-end mb-2 d-md-block d-none">
    <button id="refreshTableBtn" class="btn btn-dark btn-sm" data-url="{{ route('spot.table.refresh') }}">
        <i class="bi bi-arrow-clockwise"></i> Muat Ulang Tabel
    </button>
</div> --}}

{{-- <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#importListSpotModal">
    <i class="bi bi-cloud-upload-fill me-1"></i> Impor Daftar Spot
</button> --}}

{{-- <a href="{{ route('map.export') }}" class="btn btn-success btn-sm">
    <i class="bi bi-cloud-download-fill me-1"></i> Ekspor Daftar Spot
</a> --}}

<button class="btn btn-danger btn-sm" id="deleteAllBtnDesktop" disabled>
    <i class="bi bi-trash me-1"></i> Hapus Semua
</button>
