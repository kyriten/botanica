<!-- Modal untuk Pilih Kebun Raya -->
<div id="selectGardenModal" class="modal" tabindex="-1" style="display:block; background: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <h5 class="modal-title mb-3">Pilih Kebun Raya</h5>
            <select id="gardenSelect" name="garden_id" class="form-control mb-3">
                <option value="">-- Pilih Kebun Raya --</option>
                @foreach ($garden as $g)
                    <option value="{{ $g->id }}">{{ $g->name }}</option>
                @endforeach
            </select>
            <button id="confirmGarden" class="btn btn-primary w-100">Konfirmasi</button>
        </div>
    </div>
</div>
