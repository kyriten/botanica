<!-- Modal Pilih Wilayah -->
<div class="modal fade" id="locationSelectModal" tabindex="-1" aria-labelledby="locationSelectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-4">
      <h5 class="modal-title mb-3">Pilih Wilayah</h5>
      <select id="locationSelect" class="form-control mb-3">
        <option value="">-- Pilih Wilayah --</option>
        <option value="{{ route('province.index') }}">Provinsi</option>
        <option value="{{ route('city.index') }}">Kota</option>
        <option value="{{ route('district.index') }}">Kecamatan</option>
        <option value="{{ route('village.index') }}">Kelurahan</option>
      </select>
      <button id="confirmLocationBtn" class="btn btn-botanica w-100">Lihat</button>
    </div>
  </div>
</div>
