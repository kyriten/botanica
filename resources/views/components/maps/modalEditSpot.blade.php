<!-- Modal untuk Edit Data Spot Kebun Raya -->
<div id="editSpotModal" class="modal fade" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-4">
            <button type="button"
                class="btn-close bg-white border border-dark rounded-circle shadow position-absolute top-0 end-0 m-3 p-2"
                data-bs-dismiss="modal" aria-label="Close"></button>

            <h5 class="modal-title mb-3" id="editModalLabel">Edit Spot</h5>

            <form id="editForm" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <input type="hidden" name="garden_id" id="selectedGardenIdEdit">

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
                                <img id="imgPreviewPlantEdit"
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
                                    <label class="form-label text-white mb-0" for="customFilePlantEdit">Pilih
                                        gambar</label>
                                    <input class="form-control d-none @error('plant_image') is-invalid @enderror"
                                        id="customFilePlantEdit" name="plant_image" type="file"
                                        accept="image/png, image/jpeg, image/jpg"
                                        onchange="showPreview(event, 'imgPreviewPlantEdit');">
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
                                <img id="imgPreviewLeafEdit"
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
                                    <label class="form-label text-white mb-0" for="customFileLeafEdit">Pilih
                                        gambar</label>
                                    <input class="form-control d-none @error('leaf_image') is-invalid @enderror"
                                        id="customFileLeafEdit" name="leaf_image" type="file"
                                        accept="image/png, image/jpeg, image/jpg"
                                        onchange="showPreview(event, 'imgPreviewLeafEdit');">
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
                                <img id="imgPreviewStemEdit"
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
                                    <label class="form-label text-white mb-0" for="customFileStemEdit   ">Pilih
                                        gambar</label>
                                    <input class="form-control d-none @error('stem_image') is-invalid @enderror"
                                        id="customFileStemEdit  " name="stem_image" type="file"
                                        accept="image/png, image/jpeg, image/jpg"
                                        onchange="showPreview(event, 'imgPreviewStemEdit');">
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
                                <img id="imgPreviewFlowerEdit"
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
                                    <label class="form-label text-white mb-0" for="customFileFlowerEdit">Pilih
                                        gambar</label>
                                    <input class="form-control d-none @error('flower_image') is-invalid @enderror"
                                        id="customFileFlowerEdit" name="flower_image" type="file"
                                        accept="image/png, image/jpeg, image/jpg"
                                        onchange="showPreview(event, 'imgPreviewFlowerEdit');">
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
                                <img id="imgPreviewFruitEdit"
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
                                    <label class="form-label text-white mb-0" for="customFileFruitEdit">Pilih
                                        gambar</label>
                                    <input class="form-control d-none @error('fruit_image') is-invalid @enderror"
                                        id="customFileFruitEdit" name="fruit_image" type="file"
                                        accept="image/png, image/jpeg, image/jpg"
                                        onchange="showPreview(event, 'imgPreviewFruitEdit');">
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
                                <img id="imgPreviewAnotherEdit"
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
                                    <label class="form-label text-white mb-0" for="customFileAnotherEdit   ">Pilih
                                        gambar</label>
                                    <input class="form-control d-none @error('another_image') is-invalid @enderror"
                                        id="customFileAnotherEdit  " name="another_image" type="file"
                                        accept="image/png, image/jpeg, image/jpg"
                                        onchange="showPreview(event, 'imgPreviewAnotherEdit');">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="mt-3 mb-3">

                <div class="col-md-12 mb-3">
                    <span class="text-sm note-flag fw-bold" id="toggleCollapsePersebaranEdit">
                        Persebaran
                        <i id="arrowPersebaranIconEdit" class="bi bi-caret-down-fill"></i></span>
                </div>

                <div class="collapse" id="collapsePersebaranEdit">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <!-- Kota/Kabupaten -->
                            <label for="editCityName" class="form-label text-dark">Kota/Kabupaten</label>
                            <select name="city_id" id="editCityName"
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
                            <label for="editProvinceName" class="form-label text-dark">Provinsi</label>
                            <input class="form-control" id="editProvinceName" type="text" value=""
                                aria-label="readonly" readonly />
                        </div>
                    </div>
                </div>

                <hr class="mt-3 mb-3">

                <div class="col-md-12 mb-3">
                    <span class="text-sm note-flag fw-bold" id="toggleCollapseDetailEdit">
                        Detail Informasi
                        <i id="arrowDetailIconEdit" class="bi bi-caret-down-fill"></i></span>
                </div>

                <div class="collapse" id="collapseDetailEdit">
                    <div class="row mb-3">
                        <!-- Jenis Tanaman -->
                        <div class="col-md-12">
                            <label class="form-label text-dark" for="editCategory">Jenis Tanaman<span
                                    class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="editCategory"
                                class="form-control @error('category') is-invalid @enderror" name="category"
                                placeholder="Nama Lokal" />
                            @error('category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Nama Lokal Tanaman -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="editLocal">Nama Lokal Tanaman<span
                                    class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="editLocal"
                                class="form-control @error('local') is-invalid @enderror" name="local"
                                placeholder="Nama Lokal" />
                            @error('local')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Nama Latin Tanaman -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="editLatin">Nama Latin Tanaman<span
                                    class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="editLatin"
                                class="form-control @error('latin') is-invalid @enderror" name="latin"
                                placeholder="Nama Latin">
                            @error('latin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Slug -->
                        <div class="col-md-6">
                            <label for="editSlug" class="form-label text-dark">Slug</label>
                            <input type="text" id="editSlug" class="form-control" name="slug" readonly />
                        </div>

                        <!-- Kingdom -->
                        <div class="col-md-6">
                            <label for="editKingdom" class="form-label text-dark">Kingdom Tanaman<span
                                    class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="editKingdom"
                                class="form-control @error('kingdom') is-invalid @enderror" name="kingdom"
                                placeholder="kingdom" />
                            @error('kingdom')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Sub Kingdom -->
                        <div class="col-md-6">
                            <label for="editSubkingdom" class="form-label text-dark">Sub Kingdom<span
                                    class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="editSubkingdom"
                                class="form-control @error('sub_kingdom') is-invalid @enderror" name="sub_kingdom"
                                placeholder="sub kingdom" />
                            @error('sub_kingdom')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Super Division -->
                        <div class="col-md-6">
                            <label for="editSuperdivision" class="form-label text-dark">Super Divisi<span
                                    class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="editSuperdivision"
                                class="form-control @error('super_division') is-invalid @enderror"
                                name="super_division" placeholder="super divisi" />
                            @error('super_division')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Division -->
                        <div class="col-md-6">
                            <label for="editDivision" class="form-label text-dark">Divisi<span class="text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="editDivision"
                                class="form-control @error('division') is-invalid @enderror" name="division"
                                placeholder="divisi" />
                            @error('division')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Class -->
                        <div class="col-md-6">
                            <label for="editClass" class="form-label text-dark">Kelas<span class="text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="editClass"
                                class="form-control @error('class') is-invalid @enderror" name="class"
                                placeholder="kelas" />
                            @error('class')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Sub Class -->
                        <div class="col-md-6">
                            <label for="editSubClass" class="form-label text-dark">Sub Kelas<span class="text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="editSubClass"
                                class="form-control @error('sub_class') is-invalid @enderror" name="sub_class"
                                placeholder="sub kelas" />
                            @error('sub_class')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Ordo -->
                        <div class="col-md-6">
                            <label for="editOrdo" class="form-label text-dark">Ordo<span class="text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="editOrdo"
                                class="form-control @error('ordo') is-invalid @enderror" name="ordo"
                                placeholder="ordo" />
                            @error('ordo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Famili -->
                        <div class="col-md-6">
                            <label for="editFamili" class="form-label text-dark">Famili<span class="text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="editFamili"
                                class="form-control @error('famili') is-invalid @enderror" name="famili"
                                placeholder="famili" />
                            @error('famili')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Genus -->
                        <div class="col-md-6">
                            <label for="editGenus" class="form-label text-dark">Genus<span class="text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="editGenus"
                                class="form-control @error('genus') is-invalid @enderror" name="genus"
                                placeholder="genus" />
                            @error('genus')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Species -->
                        <div class="col-md-6">
                            <label for="editSpesies" class="form-label text-dark">Spesies<span class="text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="editSpesies"
                                class="form-control @error('species') is-invalid @enderror" name="species"
                                placeholder="spesies" />
                            @error('species')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-md-6">
                            <label for="editDeskripsi" class="form-label text-dark">Deskripsi<span
                                    class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Wajib diisi">*</span></label>
                            <input type="text" id="editDeskripsi"
                                class="form-control @error('description') is-invalid @enderror" name="description"
                                placeholder="deskripsi" />
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="mt-3 mb-3">

                <div class="col-md-12 mb-3">
                    <span class="text-sm note-flag fw-bold">Tandai Spot</span>
                </div>

                <div class="row mb-3">
                    <!-- Latitude -->
                    <div class="col-md-6">
                        <label for="editPlantLat" class="form-label text-dark">Latitude<span class="text-danger"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Wajib diisi">*</span></label>
                        <input type="text" class="form-control" id="editPlantLat" name="plant_lat"
                            placeholder="Latitude" readonly />
                    </div>

                    <!-- Longitude -->
                    <div class="col-md-6">
                        <label for="editPlantLong" class="form-label text-dark">Longitude<span class="text-danger"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Wajib diisi">*</span></label>
                        <input type="text" class="form-control" id="editPlantLong" name="plant_long"
                            placeholder="Longitude" readonly />
                    </div>
                </div>

                <!-- Map Picker -->
                <div class="mb-4">
                    <label for="editPlantLatLong" class="form-label text-dark mb-2" id="pickGardenSpot">Tandai
                        Lokasi<span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Wajib diisi">*</span></label>

                    <div id="mapEditSpot" style="height: 400px; width: 100%; border: 1px solid #ccc;"></div>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Kembali
                    </button>

                    <button type="submit" class="btn btn-botanica">Simpan Lokasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
