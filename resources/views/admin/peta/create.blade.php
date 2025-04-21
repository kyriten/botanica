@extends('admin.app')
@section('post')
    <main class="main" id="main">

        <div class="pagetitle">
            <h1>Tambah Pin Baru</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('map.create') }}">Tambah Pin Baru</a></li>
                    <li class="breadcrumb-item active">Tambah Pin</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form id="addMarkerForm" action="{{ route('map.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{-- Upload Image --}}
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                {{-- Image --}}
                                <h5 class="card-title fs-4 mb-0 pb-2">Unggah Gambar
                                    <br>
                                    <p class="text-secondary mt-2 mb-3 textf-justify" style="font-size: 14px">Hanya gambar
                                        yang dapat
                                        diunggah. <br> Mohon
                                        unggah
                                        dengan
                                        ekstensi .png, .jpg, .jpeg</p>
                                </h5>

                                <div class="row">
                                    <!-- Gambar Tumbuhan -->
                                    <div class="col-sm-4">
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
                                            <div class="btn btn-primary btn-rounded mb-3">
                                                <label class="form-label text-white mb-0" for="customFilePlant">Pilih gambar
                                                    tumbuhan</label>
                                                <input
                                                    class="form-control d-none @error('plant_image') is-invalid @enderror"
                                                    id="customFilePlant" name="plant_image" type="file"
                                                    accept="image/png, image/jpeg, image/jpg"
                                                    onchange="showPreview(event, 'imgPreviewPlant');">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Gambar Daun -->
                                    <div class="col-sm-4">
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
                                            <div class="btn btn-primary btn-rounded mb-3">
                                                <label class="form-label text-white mb-0" for="customFileLeaf">Pilih gambar
                                                    daun</label>
                                                <input class="form-control d-none @error('leaf_image') is-invalid @enderror"
                                                    id="customFileLeaf" name="leaf_image" type="file"
                                                    accept="image/png, image/jpeg, image/jpg"
                                                    onchange="showPreview(event, 'imgPreviewLeaf');">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Gambar Batang -->
                                    <div class="col-sm-4">
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
                                            <div class="btn btn-primary btn-rounded mb-3">
                                                <label class="form-label text-white mb-0" for="customFileStem">Pilih gambar
                                                    batang</label>
                                                <input class="form-control d-none @error('stem_image') is-invalid @enderror"
                                                    id="customFileStem" name="stem_image" type="file"
                                                    accept="image/png, image/jpeg, image/jpg"
                                                    onchange="showPreview(event, 'imgPreviewStem');">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Image --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 w-full">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fs-4">Tambah Pin</h5>

                                <!-- Nama Tumbuhan -->
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <span class="text-sm note-flag fw-bold">Tumbuhan</span>
                                    </div>
                                    <label for="namaTumbuhan" class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Nama
                                        Tumbuhan <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Wajib diisi">*</span></label>
                                    <div class="col-sm-10 mb-3">
                                        <select name="post_id" id="namaTumbuhan"
                                            class="form-select select2 @error('post_id') is-invalid @enderror"
                                            data-placeholder="-- Pilih Nama Tumbuhan --" required>
                                            <option value="">-- Pilih Nama Tumbuhan --</option>
                                            @foreach ($post as $key)
                                                <option value="{{ $key->id }}"
                                                    {{ old('post_id') == $key->id ? 'selected' : '' }}>
                                                    {{ $key->local }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('local')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <span class="text-sm note-flag fw-bold">Kota/Kabupaten</span>
                                        <!-- Kota/Kabupaten -->
                                        <div class="row mb-1">
                                            <label for="cityID"
                                                class="col-sm-4 col-form-label text-dark align-items-center"
                                                style="font-size: 14px">Nama <span class="text-danger"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Wajib diisi">*</span></label>
                                            <div class="col-sm-12 mb-2">
                                                <select name="city_id" id="cityID"
                                                    class="form-select select2 @error('city_id') is-invalid @enderror"
                                                    data-placeholder="-- Pilih Kota/Kabupaten --" required>
                                                    <option value="">-- Pilih Kota/Kabupaten --</option>
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}"
                                                            {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                                            {{ $city->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- Latitude -->
                                        <div class="row mb-1">
                                            <label class="col-sm-4 col-form-label text-dark align-items-center"
                                                style="font-size: 14px">Latitude <span class="text-danger"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Wajib diisi">*</span></label>
                                            <div class="col-sm-12 mb-2">
                                                <input class="form-control" type="text" name="latitude"
                                                    id="latCity" readonly>
                                            </div>
                                        </div>

                                        <!-- Longitude -->
                                        <div class="row mb-1">
                                            <label class="col-sm-4 col-form-label text-dark align-items-center"
                                                style="font-size: 14px">Longitude <span class="text-danger"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Wajib diisi">*</span></label>
                                            <div class="col-sm-12 mb-3">
                                                <input class="form-control" type="text" name="longitude"
                                                    id="longCity" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <span class="text-sm note-flag fw-bold">Provinsi</span>
                                        <!-- Provinsi -->
                                        <div class="row mb-1">
                                            <label for="provinceID"
                                                class="col-sm-4 col-form-label text-dark align-items-center"
                                                style="font-size: 14px">Nama</label>
                                            <div class="col-sm-12 mb-1" data-mdb-input-init>
                                                <input class="form-control" id="provinceID" type="text"
                                                    value="" aria-label="readonly" readonly />
                                            </div>
                                        </div>

                                        <!-- Latitude -->
                                        <div class="row mb-1">
                                            <label class="col-sm-4 col-form-label text-dark align-items-center"
                                                style="font-size: 14px">Latitude</label>
                                            <div class="col-sm-12 mb-1">
                                                <input class="form-control" type="text" name="latitude"
                                                    id="latProvince" readonly>
                                            </div>
                                        </div>

                                        <!-- Longitude -->
                                        <div class="row mb-1">
                                            <label class="col-sm-4 col-form-label text-dark align-items-center"
                                                style="font-size: 14px">Longitude</label>
                                            <div class="col-sm-12 mb-1">
                                                <input class="form-control" type="text" name="longitude"
                                                    id="longProvince" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button class="btn btn-dark fw-bold text-light" id="reset"
                                        type="reset">{{ __('RESET') }}</button>
                                    <button class="btn btn-primary fw-bold text-light" id="submit"
                                        type="submit">{{ __('SUBMIT') }}</button>
                                </div>
                                <!-- End General Form Elements -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{-- <div class="row">
                <div class="col-lg-12 w-full">
                    <div class="card">

                        <div id="map" style="height: 500px;"></div>
                        <script>
                            var map = L.map('map').setView([1.2448327, 120.830595], 5);

                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

                            var tiles = L.tileLayer(
                                'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZXJpcHJhdGFtYSIsImEiOiJjbGZubmdib3UwbnRxM3Bya3M1NGE4OHRsIn0.oxYqbBbaBwx0dHLguu5gOA', {
                                    maxZoom: 18,
                                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                    id: 'mapbox/streets-v11',
                                    tileSize: 512,
                                    zoomOffset: -1
                                }).addTo(map);

                            // Fungsi untuk menambahkan marker saat formulir dikirim
                            document.getElementById('addMarkerForm').addEventListener('submit', function(e) {
                                e.preventDefault();

                                var namaRempah = document.querySelector('input[name="nama_rempah"]').value;
                                var latitude = document.querySelector('input[name="latitude"]').value;
                                var longitude = document.querySelector('input[name="longitude"]').value;

                                // Validasi input, pastikan data sudah sesuai
                                if (namaRempah && latitude && longitude) {
                                    L.marker([parseFloat(latitude), parseFloat(longitude)])
                                        .addTo(map)
                                        .bindPopup(namaRempah) // Tampilkan informasi nama rempah di dalam marker
                                        .openPopup();
                                } else {
                                    alert('Harap isi semua field');
                                }
                            });
                        </script>
                    </div>
                </div>
            </div> --}}
        </section>
    </main><!-- End #main -->
@endsection
