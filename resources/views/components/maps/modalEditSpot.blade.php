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
                        {{-- Tumbuhan --}}
                        @include('components.maps.uploadImageField', [
                            'label' => 'Tumbuhan',
                            'imgId' => 'imgPreviewPlantEdit',
                            'imgName' => 'plant_image',
                            'imgSrc' => $map->plant_image ?? null,
                            'inputId' => 'customFilePlantEdit',
                        ])

                        {{-- Daun --}}
                        @include('components.maps.uploadImageField', [
                            'label' => 'Daun',
                            'imgId' => 'imgPreviewLeafEdit',
                            'imgName' => 'leaf_image',
                            'imgSrc' => $map->leaf_image ?? null,
                            'inputId' => 'customFileLeafEdit',
                        ])

                        {{-- Batang --}}
                        @include('components.maps.uploadImageField', [
                            'label' => 'Batang',
                            'imgId' => 'imgPreviewStemEdit',
                            'imgName' => 'stem_image',
                            'imgSrc' => $map->stem_image ?? null,
                            'inputId' => 'customFileStemEdit',
                        ])
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <div class="d-flex justify-content-center flex-nowrap gap-3 pb-3">
                        {{-- Bunga --}}
                        @include('components.maps.uploadImageField', [
                            'label' => 'Bunga',
                            'imgId' => 'imgPreviewFlowerEdit',
                            'imgName' => 'flower_image',
                            'imgSrc' => $map->flower_image ?? null,
                            'inputId' => 'customFileFlowerEdit',
                        ])

                        {{-- Buah --}}
                        @include('components.maps.uploadImageField', [
                            'label' => 'Buah',
                            'imgId' => 'imgPreviewFruitEdit',
                            'imgName' => 'fruit_image',
                            'imgSrc' => $map->fruit_image ?? null,
                            'inputId' => 'customFileFruitEdit',
                        ])

                        {{-- Lain-lain --}}
                        @include('components.maps.uploadImageField', [
                            'label' => 'Lain-lain',
                            'imgId' => 'imgPreviewAnotherEdit',
                            'imgName' => 'another_image',
                            'imgSrc' => $map->another_image ?? null,
                            'inputId' => 'customFileAnotherEdit',
                        ])
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

                <div class="collapse show" id="collapseDetailEdit">
                    <div class="row mb-3">
                        <!-- Jenis Tanaman -->
                        <div class="col-md-12">
                            <label class="form-label text-dark" for="editCategory">Jenis Tanaman<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="editCategory"
                                class="form-control @error('category') is-invalid @enderror" name="category"
                                value="{{ old('category', $map->category ?? '') }}" placeholder="Jenis Tanaman" />
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Nama Lokal -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="editLocal">Nama Lokal<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="editLocal"
                                class="form-control @error('local') is-invalid @enderror" name="local"
                                value="{{ old('local', $map->local ?? '') }}" placeholder="Nama Lokal" />
                            @error('local')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Latin -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="editLatin">Nama Latin<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="editLatin"
                                class="form-control @error('latin') is-invalid @enderror" name="latin"
                                value="{{ old('latin', $map->latin ?? '') }}" placeholder="Nama Latin" />
                            @error('latin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Slug -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="editSlug">Slug</label>
                            <input type="text" id="editSlug" class="form-control" name="slug"
                                value="{{ old('slug', $map->slug ?? '') }}" readonly />
                        </div>

                        <!-- Kingdom -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="editKingdom">Kingdom<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="editKingdom"
                                class="form-control @error('kingdom') is-invalid @enderror" name="kingdom"
                                value="{{ old('kingdom', $map->kingdom ?? '') }}" placeholder="Kingdom" />
                            @error('kingdom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Sub Kingdom -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="editSubkingdom">Sub Kingdom<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="editSubkingdom"
                                class="form-control @error('sub_kingdom') is-invalid @enderror" name="sub_kingdom"
                                value="{{ old('sub_kingdom', $map->sub_kingdom ?? '') }}" placeholder="Sub Kingdom" />
                            @error('sub_kingdom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Super Division -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="editSuperdivision">Super Divisi<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="editSuperdivision"
                                class="form-control @error('super_division') is-invalid @enderror"
                                name="super_division" value="{{ old('super_division', $map->super_division ?? '') }}"
                                placeholder="Super Divisi" />
                            @error('super_division')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Division -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="editDivision">Divisi<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="editDivision"
                                class="form-control @error('division') is-invalid @enderror" name="division"
                                value="{{ old('division', $map->division ?? '') }}" placeholder="Divisi" />
                            @error('division')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Class -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="editClass">Kelas<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="editClass"
                                class="form-control @error('class') is-invalid @enderror" name="class"
                                value="{{ old('class', $map->class ?? '') }}" placeholder="Kelas" />
                            @error('class')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Sub Class -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="editSubClass">Sub Kelas<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="editSubClass"
                                class="form-control @error('sub_class') is-invalid @enderror" name="sub_class"
                                value="{{ old('sub_class', $map->sub_class ?? '') }}" placeholder="Sub Kelas" />
                            @error('sub_class')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Ordo -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="editOrdo">Ordo<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="editOrdo"
                                class="form-control @error('ordo') is-invalid @enderror" name="ordo"
                                value="{{ old('ordo', $map->ordo ?? '') }}" placeholder="Ordo" />
                            @error('ordo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Famili -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="editFamili">Famili<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="editFamili"
                                class="form-control @error('famili') is-invalid @enderror" name="famili"
                                value="{{ old('famili', $map->famili ?? '') }}" placeholder="Famili" />
                            @error('famili')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Genus -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="editGenus">Genus<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="editGenus"
                                class="form-control @error('genus') is-invalid @enderror" name="genus"
                                value="{{ old('genus', $map->genus ?? '') }}" placeholder="Genus" />
                            @error('genus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Species -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="editSpesies">Spesies<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="editSpesies"
                                class="form-control @error('species') is-invalid @enderror" name="species"
                                value="{{ old('species', $map->species ?? '') }}" placeholder="Spesies" />
                            @error('species')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-md-6">
                            <label class="form-label text-dark" for="editDeskripsi">Deskripsi<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="editDeskripsi"
                                class="form-control @error('description') is-invalid @enderror" name="description"
                                value="{{ old('description', $map->description ?? '') }}" placeholder="Deskripsi" />
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
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
                        <label class="form-label text-dark" for="editPlantLat">Latitude<span
                                class="text-danger">*</span></label>
                        <input type="text" id="editPlantLat" class="form-control" name="plant_lat"
                            value="{{ old('plant_lat', $map->plant_lat ?? '') }}" readonly />
                    </div>

                    <!-- Longitude -->
                    <div class="col-md-6">
                        <label class="form-label text-dark" for="editPlantLong">Longitude<span
                                class="text-danger">*</span></label>
                        <input type="text" id="editPlantLong" class="form-control" name="plant_long"
                            value="{{ old('plant_long', $map->plant_long ?? '') }}" readonly />
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
