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
                    <div class="col-lg-4">
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

                                <div>
                                    <div class="mb-4 d-flex justify-content-center">
                                        <img id="imgPreview"
                                            src="http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg"
                                            alt="image placeholder" style="width: 300px;" />
                                    </div>
                                    <div class="mb-2 d-block text-center text-danger">
                                        @error('image')
                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <div class="btn btn-primary btn-rounded">
                                            <label class="form-label text-white m-1" for="customFile1">Choose file</label>
                                            <input
                                                class="imgPreview form-control d-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('image') is-invalid @enderror"
                                                id="customFile1" name="image" type="file"
                                                accept="image/png, image/jpeg, image/jpg" onchange="showPreview(event);">
                                        </div>
                                    </div>
                                </div>
                                {{-- End Image --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 w-full">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fs-4">Tambah Pin</h5>

                                <!-- Nama Tumbuhan -->
                                <div class="row mb-3">
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

                                <!-- Kelurahan/Desa -->
                                <div class="row mb-3">
                                    <label for="villageID" class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Kelurahan/Desa <span class="text-danger"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Wajib diisi">*</span></label>
                                    <div class="col-sm-10 mb-3">
                                        <select name="village_id" id="villageID"
                                            class="form-select select2 @error('village_id') is-invalid @enderror"
                                            data-placeholder="-- Pilih Kelurahan/Desa --" required>
                                            <option value="">-- Pilih Kelurahan/Desa --</option>
                                            @foreach ($villages as $village)
                                                <option value="{{ $village->id }}"
                                                    {{ old('pvillage_id') == $village->id ? 'selected' : '' }}>
                                                    {{ $village->name }}
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

                                <!-- Kecamatan -->
                                <div class="row mb-3">
                                    <label for="districtID" class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Kecamatan <span class="text-danger"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Wajib diisi">*</span></label>
                                    <div class="col-sm-10 mb-3">
                                        <select name="district_id" id="districtID"
                                            class="form-select select2 @error('district_id') is-invalid @enderror"
                                            data-placeholder="-- Pilih Kecamatan --" required>
                                            <option value="">-- Pilih Kecamatan --</option>
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}"
                                                    {{ old('district_id') == $district->id ? 'selected' : '' }}>
                                                    {{ $district->name }}
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

                                <!-- Kota/Kabupaten -->
                                <div class="row mb-3">
                                    <label for="cityID" class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Kota/Kabupaten <span class="text-danger"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Wajib diisi">*</span></label>
                                    <div class="col-sm-10 mb-3">
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

                                <!-- Provinsi -->
                                <div class="row mb-3">
                                    <label for="provinceID" class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Provinsi <span class="text-danger"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Wajib diisi">*</span></label>
                                    <div class="col-sm-10 mb-3">
                                        <select name="province_id" id="provinceID"
                                            class="form-select select2 @error('province_id') is-invalid @enderror"
                                            data-placeholder="-- Pilih Provinsi --" required>
                                            <option value="">-- Pilih Provinsi --</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}"
                                                    {{ old('province_id') == $province->id ? 'selected' : '' }}>
                                                    {{ $province->name }}
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
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Latitude</label>
                                    <div class="col-sm-10 mb-3">
                                        <input class="form-control" type="text" name="latitude" id="latitude"
                                            readonly>
                                    </div>
                                </div>

                                <!-- Longitude -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Longitude</label>
                                    <div class="col-sm-10 mb-3">
                                        <input class="form-control" type="text" name="longitude" id="longitude"
                                            readonly>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button class="btn btn-secondary fw-bold text-primary" id="reset"
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
