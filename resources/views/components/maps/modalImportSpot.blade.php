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
                <label for="importSpotForm"
                    class="form-label mt-2 mb-2 alert-warning pt-2 pb-2 ps-3 pe-3 rounded col-12"><strong>Perhatian!</strong>
                    <br> Impor data taksonomi untuk seluruh kebun raya. <br> Unggah file <strong>xlsx, xls</strong> atau
                    <strong>csv</strong></label>
                <form id="importSpotForm" action="{{ route('map.import') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <input type="file" class="form-control" id="csv-file" name="csv_file"
                            accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                            required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-botanica">Unggah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
