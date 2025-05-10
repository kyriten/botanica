@extends('admin.app')
@section('post')
    @include('components.maps.modalSelectGarden')

    @include('components.maps.modalInputSpot')

    @include('components.maps.modalEditSpot')

    @include('components.maps.modalImportSpot')

    @include('components.maps.modalGambarSpot')

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
                            <li class="breadcrumb-item active"><a href="{{ route('map.index') }}">Daftar Spot Tanaman</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div><!-- End Page Title -->

        <section class="section" id="contentArea" style="display:none;">
            <div class="row fade-in">
                <div id="alert-container"></div>

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
                                        <form id="search-form" action="{{ route('map.index') }}" method="GET"
                                            class="search-form">
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
                                                        <form action="{{ route('map.destroy', $item->id) }}" method="post"
                                                            class="d-inline">
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

            document.getElementById('inputSpotModal').addEventListener('shown.bs.modal', function () {
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
                markerSpot = L.marker([lat, lng], {draggable:true}).addTo(mapSpot);

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

@push('styles')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <!-- jQuery & Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('js/maps.js') }}"></script>
@endpush
