@extends('admin.app')
@section('post')
    <main class="main" id="main">

        <div class="pagetitle">
            <h1>Tambah Kecamatan Baru</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('district.index') }}">Kecamatan</a></li>
                    <li class="breadcrumb-item active">Kecamatan Baru</li>
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
            <form id="addMarkerForm" action="{{ route('district.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 w-full">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fs-4">Masukkan Koordinat Baru</h5>

                                <div class="row mb-3">
                                    <label for="provinceID" class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Nama Provinsi</label>
                                    <div class="col-sm-10 mb-3" data-mdb-input-init>
                                        <input class="form-control" id="provinceID" type="text"
                                            value="" aria-label="readonly" readonly />
                                    </div>
                                </div>

                                <!-- Nama Kota/Kabupaten -->
                                <div class="row mb-3">
                                    <label for="cityID" class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Nama Kota/Kabupaten <span class="text-danger"
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

                                <!-- Nama Kecamatan -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Nama Kecamatan <span class="text-danger"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Wajib diisi">*</span></label>
                                    <div class="col-sm-10 mb-3">
                                        <input class="form-control  @error('name')is-invalid @enderror" type="text"
                                            name="name" id="name" value="{{ old('name') }}" required>
                                        <span class="form-text">Gunakan alfabet dan titik. Tambahkan kata
                                            "Kecamatan" sebelum nama. <br> <strong>Contoh:</strong>
                                            <strong>Kecamatan</strong>
                                            Bogor Utara, <strong>Kecamatan</strong> Bojong Gede.</span>
                                    </div>
                                    @error('name')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Alt Nama Kecamatan -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Alt Nama Kecamatan <span class="text-danger"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Wajib diisi">*</span></label>
                                    <div class="col-sm-10 mb-3">
                                        <input class="form-control  @error('alt_name')is-invalid @enderror" type="text"
                                            name="alt_name" id="alt_name" value="{{ old('alt_name') }}" required>
                                        <span class="form-text">Gunakan alfabet dan titik</span>
                                    </div>
                                    @error('alt_name')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Latitude -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Latitude <span class="text-danger" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Wajib diisi">*</span></label>
                                    <div class="col-sm-10 mb-3">
                                        <input class="form-control  @error('latitude')is-invalid @enderror" type="number"
                                            name="latitude" id="latitude" value="{{ old('latitude') }}" required>
                                        <span class="form-text">Gunakan angka dan titik</span>
                                    </div>
                                    @error('latitude')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Longitude -->
                                <div class="row
                                            mb-3">
                                    <label class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Longitude <span class="text-danger" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Wajib diisi">*</span></label>
                                    <div class="col-sm-10 mb-3">
                                        <input class="form-control @error('longitude')is-invalid @enderror" type="number"
                                            name="longitude" id="longitude" value="{{ old('longitude') }}" required>
                                        <span class="form-text">Gunakan angka dan titik</span>
                                    </div>
                                    @error('longitude')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="text-end">
                                    <button class="btn btn-dark fw-bold text-light" id="reset"
                                        type="reset">{{ __('KOSONGKAN FORMULIR') }}</button>
                                    <button class="btn btn-botanica fw-bold text-light" id="submit"
                                        type="submit">{{ __('KIRIM') }}</button>
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
