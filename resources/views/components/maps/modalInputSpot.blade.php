<!-- Modal untuk Input Data Spot Kebun Raya -->
<div id="inputSpotModal" class="modal fade" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true"
    style="display:none; background: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-4">
            <button type="button"
                class="btn-close bg-white border border-dark rounded-circle shadow position-absolute top-0 end-0 m-3 p-2"
                data-bs-dismiss="modal" aria-label="Close"></button>

            <h5 class="modal-title mb-3" id="titleModalInputSpot">Tambah Spot Baru</h5>

            <form id="map-form" data-url="{{ route('map.store') }}" data-token="{{ csrf_token() }}" method="post"
                enctype="multipart/form-data">

                @csrf
                <input type="hidden" name="garden_id" id="selectedGardenId">

                <div class="col-md-12 mb-3">
                    <span class="text-sm note-flag fw-bold">Gambar Tanaman</span>
                </div>

                <div class="overflow-x-auto">
                    <div class="d-flex justify-content-center flex-nowrap gap-3 pb-3">
                        <!-- Gambar Tumbuhan -->
                        <div class="flex-shrink-0" style="width: 300px;">
                            <div class="position-relative mb-4 text-center">
                                <!-- Label di atas gambar -->
                                <div
                                    class="position-absolute top-0 start-50 translate-middle-x bg-primary text-white px-3 py-1 rounded-bottom text-sm">
                                    Tumbuhan
                                </div>

                                <!-- Gambar -->
                                <img id="imgPreviewPlant"
                                    src="http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg"
                                    alt="image placeholder" style="width: 200px;" />
                            </div>

                            <!-- Error message -->
                            <div class="mb-2 text-center text-danger">
                                @error('plant_image')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tombol Upload -->
                            <div class="d-flex justify-content-center">
                                <div class="btn btn-botanica btn-rounded mb-3">
                                    <label class="form-label text-white mb-0" for="customFilePlant">Pilih gambar</label>
                                    <input class="form-control d-none @error('plant_image') is-invalid @enderror"
                                        id="customFilePlant" name="plant_image" type="file"
                                        accept="image/png, image/jpeg, image/jpg"
                                        onchange="showPreview(event, 'imgPreviewPlant');">
                                </div>
                            </div>
                        </div>

                        <!-- Gambar Daun -->
                        <div class="flex-shrink-0" style="width: 300px;">
                            <div class="position-relative mb-4 text-center">
                                <!-- Label di atas gambar -->
                                <div
                                    class="position-absolute top-0 start-50 translate-middle-x bg-primary text-white px-3 py-1 rounded-bottom text-sm">
                                    Daun
                                </div>

                                <!-- Gambar -->
                                <img id="imgPreviewLeaf"
                                    src="http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg"
                                    alt="image placeholder" style="width: 200px;" />
                            </div>

                            <!-- Error message -->
                            <div class="mb-2 text-center text-danger">
                                @error('leaf_image')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tombol Upload -->
                            <div class="d-flex justify-content-center">
                                <div class="btn btn-botanica btn-rounded mb-3">
                                    <label class="form-label text-white mb-0" for="customFileLeaf">Pilih gambar</label>
                                    <input class="form-control d-none @error('leaf_image') is-invalid @enderror"
                                        id="customFileLeaf" name="leaf_image" type="file"
                                        accept="image/png, image/jpeg, image/jpg"
                                        onchange="showPreview(event, 'imgPreviewLeaf');">
                                </div>
                            </div>
                        </div>

                        <!-- Gambar Batang -->
                        <div class="flex-shrink-0" style="width: 300px;">
                            <div class="position-relative mb-4 text-center">
                                <!-- Label di atas gambar -->
                                <div
                                    class="position-absolute top-0 start-50 translate-middle-x bg-primary text-white px-3 py-1 rounded-bottom text-sm">
                                    Batang
                                </div>

                                <!-- Gambar -->
                                <img id="imgPreviewStem"
                                    src="http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg"
                                    alt="image placeholder" style="width: 200px;" />
                            </div>

                            <!-- Error message -->
                            <div class="mb-2 text-center text-danger">
                                @error('stem_image')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tombol Upload -->
                            <div class="d-flex justify-content-center">
                                <div class="btn btn-botanica btn-rounded mb-3">
                                    <label class="form-label text-white mb-0" for="customFileStem">Pilih gambar</label>
                                    <input class="form-control d-none @error('stem_image') is-invalid @enderror"
                                        id="customFileStem" name="stem_image" type="file"
                                        accept="image/png, image/jpeg, image/jpg"
                                        onchange="showPreview(event, 'imgPreviewStem');">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <div class="d-flex justify-content-center flex-nowrap gap-3 pb-3">
                        <!-- Gambar Bunga -->
                        <div class="flex-shrink-0" style="width: 300px;">
                            <div class="position-relative mb-4 text-center">
                                <!-- Label di atas gambar -->
                                <div
                                    class="position-absolute top-0 start-50 translate-middle-x bg-primary text-white px-3 py-1 rounded-bottom text-sm">
                                    Bunga
                                </div>

                                <!-- Gambar -->
                                <img id="imgPreviewFlower"
                                    src="http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg"
                                    alt="image placeholder" style="width: 200px;" />
                            </div>

                            <!-- Error message -->
                            <div class="mb-2 text-center text-danger">
                                @error('flower_image')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tombol Upload -->
                            <div class="d-flex justify-content-center">
                                <div class="btn btn-botanica btn-rounded mb-3">
                                    <label class="form-label text-white mb-0" for="customFileFlower">Pilih
                                        gambar</label>
                                    <input class="form-control d-none @error('plant_image') is-invalid @enderror"
                                        id="customFileFlower" name="flower_image" type="file"
                                        accept="image/png, image/jpeg, image/jpg"
                                        onchange="showPreview(event, 'imgPreviewFlower');">
                                </div>
                            </div>
                        </div>

                        <!-- Gambar Buah -->
                        <div class="flex-shrink-0" style="width: 300px;">
                            <div class="position-relative mb-4 text-center">
                                <!-- Label di atas gambar -->
                                <div
                                    class="position-absolute top-0 start-50 translate-middle-x bg-primary text-white px-3 py-1 rounded-bottom text-sm">
                                    Buah
                                </div>

                                <!-- Gambar -->
                                <img id="imgPreviewFruit"
                                    src="http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg"
                                    alt="image placeholder" style="width: 200px;" />
                            </div>

                            <!-- Error message -->
                            <div class="mb-2 text-center text-danger">
                                @error('fruit_image')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tombol Upload -->
                            <div class="d-flex justify-content-center">
                                <div class="btn btn-botanica btn-rounded mb-3">
                                    <label class="form-label text-white mb-0" for="customFileFruit">Pilih
                                        gambar</label>
                                    <input class="form-control d-none @error('fruit_image') is-invalid @enderror"
                                        id="customFileFruit" name="fruit_image" type="file"
                                        accept="image/png, image/jpeg, image/jpg"
                                        onchange="showPreview(event, 'imgPreviewFruit');">
                                </div>
                            </div>
                        </div>

                        <!-- Gambar Lain-lain -->
                        <div class="flex-shrink-0" style="width: 300px;">
                            <div class="position-relative mb-4 text-center">
                                <!-- Label di atas gambar -->
                                <div
                                    class="position-absolute top-0 start-50 translate-middle-x bg-primary text-white px-3 py-1 rounded-bottom text-sm">
                                    Lain-lain
                                </div>

                                <!-- Gambar -->
                                <img id="imgPreviewAnother"
                                    src="http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg"
                                    alt="image placeholder" style="width: 200px;" />
                            </div>

                            <!-- Error message -->
                            <div class="mb-2 text-center text-danger">
                                @error('another_image')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Tombol Upload -->
                            <div class="d-flex justify-content-center">
                                <div class="btn btn-botanica btn-rounded mb-3">
                                    <label class="form-label text-white mb-0" for="customFileAnother">Pilih
                                        gambar</label>
                                    <input class="form-control d-none @error('another_image') is-invalid @enderror"
                                        id="customFileAnother" name="another_image" type="file"
                                        accept="image/png, image/jpeg, image/jpg"
                                        onchange="showPreview(event, 'imgPreviewAnother');">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="mt-3 mb-3">

                <div class="col-md-12 mb-3">
                    <span class="text-sm note-flag fw-bold" id="toggleCollapsePersebaran">
                        Persebaran
                        <i id="arrowPersebaranIcon" class="bi bi-caret-down-fill"></i></span>
                </div>

                <div class="collapse" id="collapsePersebaran">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <!-- Kota/Kabupaten -->
                            <label for="selectCity" class="form-label text-dark">Kota/Kabupaten</label>
                            <select name="city_id" id="selectCity"
                                class="form-select @error('city_id') is-invalid @enderror"
                                data-placeholder="-- Pilih Kota/Kabupaten --">
                                <option></option>
                                @foreach ($city as $c)
                                    <option value="{{ $c->id }}" data-province="{{ $c->province->name }}">
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="selectProvince" class="form-label text-dark">Provinsi</label>
                            <input class="form-control" id="selectProvince" type="text" value=""
                                aria-label="readonly" readonly />
                        </div>
                    </div>
                </div>

                <hr class="mt-3 mb-3">

                <div class="col-md-12 mb-3">
                    <span class="text-sm note-flag fw-bold" id="toggleCollapseDetail">
                        Detail Informasi
                        <i id="arrowDetailIcon" class="bi bi-caret-down-fill"></i></span>
                </div>

                <div class="collapse" id="collapseDetail">
                    <div class="row mb-3">
                        <!-- Jenis Tanaman -->
                        <div class="col-md-12">
                            <label class="form-label text-dark" for="jenisTanaman">Jenis Tanaman<span
                                    class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="jenisTanaman" class="form-control" name="category"
                                placeholder="Jenis Tanaman" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Nama Lokal Tanaman -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="namaLokal">Nama Lokal Tanaman<span
                                    class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="namaLokal" class="form-control" name="local"
                                placeholder="Nama Lokal" />
                        </div>

                        <!-- Nama Latin Tanaman -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="namaLatin">Nama Latin Tanaman<span
                                    class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="namaLatin" class="form-control" name="latin"
                                placeholder="Nama Latin">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Slug -->
                        <div class="col-md-6">
                            <label for="slug" class="form-label text-dark">Slug</label>
                            <input type="text" id="slug" class="form-control" name="slug" readonly />
                        </div>

                        <!-- Kingdom -->
                        <div class="col-md-6">
                            <label for="kingdomTanaman" class="form-label text-dark">Kingdom Tanaman<span
                                    class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="kingdomTanaman" class="form-control" name="kingdom"
                                placeholder="kingdom" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Sub Kingdom -->
                        <div class="col-md-6">
                            <label for="subkingdomTanaman" class="form-label text-dark">Sub Kingdom<span
                                    class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="subkingdomTanaman" class="form-control" name="sub_kingdom"
                                placeholder="sub kingdom" />
                        </div>

                        <!-- Super Division -->
                        <div class="col-md-6">
                            <label for="superdivisiTanaman" class="form-label text-dark">Super Divisi<span
                                    class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="superdivisiTanaman" class="form-control" name="super_division"
                                placeholder="super divisi" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Division -->
                        <div class="col-md-6">
                            <label for="divisiTanaman" class="form-label text-dark">Divisi<span class="text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="divisiTanaman" class="form-control" name="division"
                                placeholder="divisi" />
                        </div>

                        <!-- Class -->
                        <div class="col-md-6">
                            <label for="kelasTanaman" class="form-label text-dark">Kelas<span class="text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="kelasTanaman" class="form-control" name="class"
                                placeholder="kelas" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Sub Class -->
                        <div class="col-md-6">
                            <label for="subkelasTanaman" class="form-label text-dark">Sub Kelas<span
                                    class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="subkelasTanaman" class="form-control" name="sub_class"
                                placeholder="sub kelas" />
                        </div>

                        <!-- Ordo -->
                        <div class="col-md-6">
                            <label for="ordoTanaman" class="form-label text-dark">Ordo<span class="text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="ordoTanaman" class="form-control" name="ordo"
                                placeholder="ordo" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Famili -->
                        <div class="col-md-6">
                            <label for="familiTanaman" class="form-label text-dark">Famili<span class="text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="familiTanaman" class="form-control" name="famili"
                                placeholder="famili" />
                        </div>

                        <!-- Genus -->
                        <div class="col-md-6">
                            <label for="genusTanaman" class="form-label text-dark">Genus<span class="text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="genusTanaman" class="form-control" name="genus"
                                placeholder="genus" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Species -->
                        <div class="col-md-6">
                            <label for="spesiesTanaman" class="form-label text-dark">Spesies<span class="text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="spesiesTanaman" class="form-control" name="species"
                                placeholder="spesies" />
                        </div>

                        <!-- Persebaran -->
                        <div class="col-md-6">
                            <label for="deskripsiTanaman" class="form-label text-dark">Deskripsi<span
                                    class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="deskripsiTanaman" class="form-control" name="description"
                                placeholder="deskripsi" />
                        </div>
                    </div>
                </div>

                <hr class="mt-3 mb-3">

                <div class="col-md-12 mb-3">
                    <span class="text-sm note-flag fw-bold">Tandai Spot</span>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12 text-muted mb-2">
                        <table class="table table-bordered w-100">
                            <thead class="table">
                                <tr>
                                    <th>Jenis Format</th>
                                    <th>Contoh</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Desimal</strong></td>
                                    <td>-7.797556, 112.736861</td>
                                    <td class="text-success"><strong>Didukung</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>DMS (Derajat, Menit, Detik)</strong></td>
                                    <td>6¡Æ44'28.4"S 107¡Æ00'27.4"E</td>
                                    <td class="text-danger"><strong>Tidak Didukung</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Latitude -->
                    <div class="col-md-6">
                        <label for="latTanaman" class="form-label text-dark">Latitude<span class="text-danger"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Wajib diisi">*</span></label>
                        <input type="text" class="form-control" id="latTanaman" name="plant_lat"
                            placeholder="Masukkan Latitude" pattern="^-?\d*\.?\d*$" inputmode="decimal" />
                    </div>

                    <!-- Longitude -->
                    <div class="col-md-6">
                        <label for="longTanaman" class="form-label text-dark">Longitude<span class="text-danger"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Wajib diisi">*</span></label>
                        <input type="text" class="form-control" id="longTanaman" name="plant_long"
                            placeholder="Masukkan Longitude" pattern="^-?\d*\.?\d*$" inputmode="decimal" />
                    </div>
                </div>

                <!-- Map Picker -->
                <div class="mb-4">
                    <label for="latTanaman" class="form-label text-dark mb-0" id="pickGardenSpot">
                        Tandai Lokasi<span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Wajib diisi">*</span>
                    </label>
                    <div class="form-text text-muted mb-2">
                        Kamu juga bisa <i>pick</i> titik yang diinginkan dengan <strong>mengklik</strong> titik yang
                        diinginkan langsung pada peta.
                    </div>

                    <div id="mapSpot" style="height: 400px; width: 100%; border: 1px solid #ccc;"></div>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Kembali
                    </button>
                    <button type="submit" class="btn btn-botanica">
                        Simpan Lokasi
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
<style>
    table tr td, table tr th {
        padding-top: 2px !important;
        padding-bottom: 2px !important;
        font-size: 0.875rem;
    }
</style>
