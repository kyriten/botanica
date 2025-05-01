@extends('admin.app')
@section('post')
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

    <!-- Modal untuk Input Data Spot Kebun Raya -->
    <div id="inputSpotModal" class="modal" tabindex="-1" style="display:none; background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content p-4">
                <h5 class="modal-title mb-3">Tambah Spot Baru</h5>

                <form action="{{ route('map.store') }}" method="post">

                    {{-- Upload Image --}}
                    <div class="col-lg-12">
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
                                        <input class="form-control d-none @error('plant_image') is-invalid @enderror"
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

                    <hr>

                    <div class="col-md-12">
                        <span class="text-sm note-flag fw-bold">Tumbuhan</span>

                        <div class="row mb-1">
                            <label for="cityID" class="col-sm-4 col-form-label text-dark align-items-center"
                                style="font-size: 14px">Nama Tanaman<span class="text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Wajib diisi">*</span></label>

                            <div class="col-sm-12">
                                <!-- Nama Tanaman -->
                                <div class="form-outline" data-mdb-input-init>
                                    <input type="text" id="namaLokasi" class="form-control" />
                                    <label class="form-label" for="namaLokasi">Nama Tanaman</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <label for="cityID" class="col-sm-4 col-form-label text-dark align-items-center"
                                style="font-size: 14px">Deskripsi<span class="text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Wajib diisi">*</span></label>

                            <div class="col-sm-12 mb-4">
                                <!-- Deskripsi Tanaman -->
                                <div class="form-outline" data-mdb-input-init>
                                    <input type="text" id="namaLokasi" class="form-control" />
                                    <label class="form-label" for="namaLokasi">Deskripsi Tanaman</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Persebaran Tanaman Collapse -->
                    <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#persebaranTanamanCollapse" aria-expanded="false" aria-controls="persebaranTanamanCollapse">
                        Tambah Persebaran Tanaman
                    </button>

                    <div class="collapse" id="persebaranTanamanCollapse">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="text-sm note-flag fw-bold">Persebaran - Kota/Kabupaten</span>

                                <!-- Kota/Kabupaten -->
                                <div class="row mb-1">
                                    <label for="cityID" class="col-sm-4 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Nama </label>
                                    <div class="col-sm-12">
                                        <select name="city_id" id="cityID"
                                            class="form-select select2 @error('city_id') is-invalid @enderror"
                                            data-placeholder="-- Pilih Kota/Kabupaten --" required>
                                            <option value="">-- Pilih Kota/Kabupaten --</option>
                                            @foreach ($city as $c)
                                                <option value="{{ $c->id }}"
                                                    {{ old('city_id') == $c->id ? 'selected' : '' }}>
                                                    {{ $c->name }}
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
                                        style="font-size: 14px">Latitude</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" name="latitude" id="latCity"
                                            readonly>
                                    </div>
                                </div>

                                <!-- Longitude -->
                                <div class="row mb-1">
                                    <label class="col-sm-4 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Longitude</label>
                                    <div class="col-sm-12 mb-4">
                                        <input class="form-control" type="text" name="longitude" id="longCity"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <span class="text-sm note-flag fw-bold">Provinsi</span>
                                <!-- Provinsi -->
                                <div class="row mb-1">
                                    <label for="provinceID" class="col-sm-4 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Nama</label>
                                    <div class="col-sm-12" data-mdb-input-init>
                                        <input class="form-control" id="provinceID" type="text" value=""
                                            aria-label="readonly" readonly />
                                    </div>
                                </div>

                                <!-- Latitude -->
                                <div class="row mb-1">
                                    <label class="col-sm-4 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Latitude</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="text" name="latitude" id="latProvince"
                                            readonly>
                                    </div>
                                </div>

                                <!-- Longitude -->
                                <div class="row mb-4">
                                    <label class="col-sm-4 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Longitude</label>
                                    <div class="col-sm-12 mb-1">
                                        <input class="form-control" type="text" name="longitude" id="longProvince"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="col-md-12">
                        <span class="text-sm note-flag fw-bold">Tandai Spot Tanaman</span>

                        <div class="row mb-1">
                            <!-- Lat -->
                            <label for="latitude"
                                class="col-sm-2 col-form-label text-dark align-items-center">Latitude</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="latitude" name="latitude"
                                    placeholder="Latitude" readonly>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <!-- Long -->
                            <label for="longitude"
                                class="col-sm-2 col-form-label text-dark align-items-center">Longitude</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="longitude" name="longitude"
                                    placeholder="Longitude" readonly>
                            </div>
                        </div>

                        <div class="col-lg-12 my-3">
                            <h5 id="pickGardenSpot">Tandai Lokasi</h5>
                            <div id="mapSpot" style="height: 400px; width: 100%;"></div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary">Simpan Lokasi</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Modal untuk Impor Data Spot Kebun Raya -->
    <div id="importListSpotModal" class="modal" tabindex="-1" style="display:none; background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
                <h5 class="modal-title mb-3">Impor Daftar Spot</h5>

                <input type="file" class="form-control mb-2" id="customFile" />
                <label class="form-label" for="customFile">Unggah file excel disini</label>

                <button class="btn btn-primary">Unggah</button>
            </div>
        </div>
    </div>

    <main class="main" id="main">
        <div id="skeletonArea">
            <div class="pagetitle">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-lg-3">
                        <div class="skeleton" style="height: 100px;"></div>
                    </div>

                    <div class="col-lg-3">
                        <div class="skeleton" style="height: 50px;"></div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="skeleton" style="height: 300px;"></div>
                </div>
                <div class="col-lg-12">
                    <div class="skeleton" style="height: 500px;"></div>
                </div>
            </div>
        </div>

        <div class="pagetitle" id="titleArea" style="display:none;">
            <div class="row fade-in">
                <div class="col-lg-6 align-items-center">
                    <h1 id="pageTitle"></h1>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('map.index') }}">Peta</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('map.index') }}">Daftar Penanda</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div><!-- End Page Title -->

        <section class="section" id="contentArea" style="display:none;">
            <div class="row fade-in">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8 d-flex justify-content-start align-items-stretch my-3">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#inputSpotModal"><i class="bi bi-plus-lg me-1"></i> Tambah
                                        Spot</button>

                                    <button class="btn btn-secondary btn-sm mx-2" data-bs-toggle="modal"
                                        data-bs-target="#importListSpotModal"><i class="bi bi-cloud-upload-fill me-1"></i>
                                        Impor Daftar Spot</button>
                                </div>

                                <div class="col-lg-4 d-flex justify-content-end align-items-stretch my-3">
                                    <div class="search-bar">
                                        <form action="{{ route('map.index') }}" method="GET" class="search-form">
                                            <div class="input-group rounded">
                                                <input type="text" name="search" class="form-control"
                                                    placeholder="Search" value="{{ request('search') }}">
                                                <span class="input-group-text border-0" id="search-addon">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Tumbuhan</th>
                                            <th scope="col">Kebun Raya</th>
                                            <th scope="col">Persebaran</th>
                                            <th scope="col">Latitude</th>
                                            <th scope="col">Longitude</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($map as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->local }}</td>
                                                <td>{{ $item->garden_name }}</td>
                                                <td>{{ $item->city_name }}, {{ $item->province_name }}</td>
                                                <td>
                                                    <div class="d-flex gap-3">
                                                        <a class="btn btn-warning" href="/map/{{ $item->id }}/edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('map.destroy', $item->id) }}"
                                                            method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger"
                                                                onclick="return confirm('Apakah kamu yakin menghapus data?')">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No records available</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                    <!-- Bagian untuk menampilkan tautan paginate -->
                                </table>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item">{{ $map->links() }}</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <h5 id="previewGardenArea">Peta Pratinjau </h5>
                    <div class="mb-3" id="map" style="height: 500px; width: 100%"></div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <script>
        var gardenData = [];
        let mapInstance = null;

        fetch('/api/gardens')
            .then(response => response.json())
            .then(result => {
                gardenData = result.data;
            })
            .catch(error => {
                console.error('Error fetching gardens:', error);
                alert('Gagal mengambil data kebun');
            })

        document.getElementById('confirmGarden').addEventListener('click', function() {
            var gardenSelect = document.getElementById('gardenSelect');
            var selectedGardenId = gardenSelect.value;
            var selectedGardenName = gardenSelect.options[gardenSelect.selectedIndex].text;

            if (!selectedGardenId) {
                alert('Silakan pilih Kebun Raya dulu.');
                return;
            }

            const selectedGarden = gardenData.find(g => g.id == selectedGardenId);

            if (!selectedGarden) {
                alert('Data kebun tidak ditemukan.');
                return;
            }

            const pageTitle = document.getElementById('pageTitle');

            // Kosongkan dulu isinya
            pageTitle.innerHTML = '';

            // Buat span untuk teks
            const titleText = document.createElement('span');
            titleText.textContent = "Daftar Spot " + selectedGardenName;

            // Buat button
            const button = document.createElement('button');
            button.className = 'btn btn-secondary btn-sm mx-2';
            button.setAttribute('data-bs-toggle', 'modal');
            button.setAttribute('data-bs-target', '#selectGardenModal');

            // Buat ikon dalam button
            const icon = document.createElement('i');
            icon.className = 'bi bi-arrow-left-right';
            button.appendChild(icon);

            document.getElementById('selectGardenModal').style.display = 'none';
            document.getElementById('skeletonArea').style.display = 'none';
            document.getElementById('titleArea').style.display = 'block';
            document.getElementById('contentArea').style.display = 'block';
            document.getElementById('previewGardenArea').textContent = "Peta Pratinjau " + selectedGardenName;

            // Masukkan span dan button ke dalam h1
            pageTitle.appendChild(titleText);
            pageTitle.appendChild(button);

            if (mapInstance !== null) {
                mapInstance.remove();
            }

            mapInstance = L.map('map').setView(selectedGarden.coordinate, 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(mapInstance);

            if (selectedGarden.polygon) {
                L.polygon(selectedGarden.polygon, {
                    color: 'green',
                    fillColor: '#4CAF50',
                    fillOpacity: 0.5
                }).addTo(mapInstance).bindPopup("<b>Area Kebun Raya " + selectedGardenName + "</b>");
            }

            document.getElementById('selectGardenModal').style.display = 'none';

            document.body.classList.remove('modal-open');
            let backdrops = document.getElementsByClassName('modal-backdrop');
            while (backdrops.length > 0) {
                backdrops[0].parentNode.removeChild(backdrops[0]);
            }

            var mapSpot = L.map('mapSpot').setView(selectedGarden.coordinate, 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(mapSpot);

            if (selectedGarden.polygon) {
                L.polygon(selectedGarden.polygon, {
                    color: 'green',
                    fillColor: '#4CAF50',
                    fillOpacity: 0.5
                }).addTo(mapSpot);
            }

            document.getElementById('inputSpotModal').addEventListener('shown.bs.modal', function() {
                mapSpot.invalidateSize();
            });

            var markerSpot;

            mapSpot.on('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;

                console.log('Lokasi dipilih:', lat, lng);

                // Kalau sudah ada marker sebelumnya, hapus dulu
                if (markerSpot) {
                    mapSpot.removeLayer(markerSpot);
                }

                // Tambahkan marker baru
                markerSpot = L.marker([lat, lng], {
                    draggable: true
                }).addTo(mapSpot);

                // Isi input
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                // Kalau marker digeser (drag), update latlng juga
                markerSpot.on('dragend', function(event) {
                    var position = event.target.getLatLng();
                    document.getElementById('latitude').value = position.lat;
                    document.getElementById('longitude').value = position.lng;
                });
            });
        });
    </script>
@endsection
