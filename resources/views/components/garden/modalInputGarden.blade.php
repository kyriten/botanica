<!-- Modal untuk Input Data Garden Kebun Raya -->
<div id="inputGardenModal" class="modal fade" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true"
    style="display:none; background: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-4">
            <button type="button"
                class="btn-close bg-white border border-dark rounded-circle shadow position-absolute top-0 end-0 m-3 p-2"
                data-bs-dismiss="modal" aria-label="Close"></button>

            <h5 class="modal-title mb-3" id="titleModalInputGarden">Tambah Garden Baru</h5>

            <form id="map-form" data-url="{{ route('garden.store') }}" data-token="{{ csrf_token() }}" method="post">

                @csrf
                <div class="row mb-3">
                    <!-- Nama Kebun Raya -->
                    <div class="col-md-12">
                        <label class="form-label text-dark" for="gardenName">Nama Kebun Raya<span class="text-danger"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Wajib diisi">*</span></label>
                        <input type="text" id="gardenName" class="form-control text-capitalize" name="name"
                            placeholder="Nama Kebun Raya" autocomplete="off" />
                        <div id="capsLockWarning" class="text-danger small mt-1" style="display: none;">
                            ⚠️ Caps Lock sedang aktif. Matikan Caps Lock.
                        </div>
                        <label for="gardenName" class="text-sm-note">Contoh: <strong>Kebun Raya</strong> Bogor</label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Kembali
                    </button>
                    <button type="submit" class="btn btn-botanica">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
    /* CSS untuk kapitalisasi awal kata */
    .text-capitalize {
        text-transform: capitalize;
    }

    /* Opsional: Blokir pengetikan huruf besar (SHIFT dan CAPSLOCK) */
    input.block-uppercase {
        font-variant: normal;
    }
</style>

<script>
    const input = document.getElementById('gardenName');
    const warning = document.getElementById('capsLockWarning');
    const prefix = 'Kebun Raya ';

    input.addEventListener('focus', () => {
        if (!input.value.startsWith(prefix)) {
            input.value = prefix;
        }
        setCaretToEnd(input);
    });

    input.addEventListener('input', () => {
        if (!input.value.startsWith(prefix)) {
            const userPart = input.value.replace(prefix.trim(), '').trim();
            input.value = prefix + userPart;
        }
        input.value = toTitleCase(input.value);
        setCaretToEnd(input);
    });

    // Tampilkan peringatan jika Caps Lock aktif
    input.addEventListener('keydown', function(e) {
        if (e.getModifierState && e.getModifierState('CapsLock')) {
            warning.style.display = 'block';
        } else {
            warning.style.display = 'none';
        }

        // Blok shift key
        if (e.key === 'Shift') {
            e.preventDefault();
        }
    });

    // Sembunyikan peringatan saat user keluar dari input
    input.addEventListener('blur', function() {
        warning.style.display = 'none';
    });

    function toTitleCase(str) {
        return str.toLowerCase().split(' ').map(word =>
            word.charAt(0).toUpperCase() + word.slice(1)
        ).join(' ');
    }

    function setCaretToEnd(el) {
        setTimeout(() => {
            el.selectionStart = el.selectionEnd = el.value.length;
        }, 0);
    }
</script>
