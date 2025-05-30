<!-- Modal untuk Edit Data Garden Kebun Raya -->
<div id="editGardenModal" class="modal fade" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-4">
            <button type="button"
                class="btn-close bg-white border border-dark rounded-circle shadow position-absolute top-0 end-0 m-3 p-2"
                data-bs-dismiss="modal" aria-label="Close"></button>

            <h5 class="modal-title mb-3">Edit Garden</h5>

            <form id="editGardenForm">
                @csrf
                @method('PATCH')

                <!-- Hidden field -->
                <input type="hidden" name="slug" id="editGardenSlug">

                <!-- Nama Kebun -->
                <div class="mb-3">
                    <label for="editGardenName" class="form-label">Nama Kebun Raya</label>
                    <input type="text" class="form-control" id="editGardenName" name="name" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Kembali
                    </button>
                    <button type="submit" class="btn btn-botanica">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
