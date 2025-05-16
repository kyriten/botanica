<!-- Modal untuk Impor Data Spot Kebun Raya -->
<div class="modal fade" id="importListSpotModal" tabindex="-1" aria-labelledby="importListSpotModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importListSpotModalLabel">Impor Daftar Spot</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <form id="importSpotForm" action="{{ route('map.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <input type="file" class="form-control" id="customFile" name="csv_file"
                            accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                            required>
                        <label for="customFile" class="form-label">Catatan: Unggah file Excel atau CSV</label>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-botanica">Unggah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
