@extends('admin.app')
@section('post')
    <!-- Modal untuk Pilih Kebun Raya -->
    <div id="selectGardenModal" class="modal" tabindex="-1" style="display:block; background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
                <h5 class="modal-title mb-3">Pilih Kebun Raya</h5>
                <select id="gardenSelect" class="form-control mb-3">
                    <option value="">-- Pilih Kebun Raya --</option>
                    @foreach ($garden as $garden)
                        <option value="{{ $garden->id }}">{{ $garden->name }}</option>
                    @endforeach
                </select>
                <button id="confirmGarden" class="btn btn-primary w-100">Konfirmasi</button>
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
                <div class="col-lg-6">
                    <h1 id="pageTitle"></h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('map.index') }}">Peta</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('map.index') }}">Daftar Penanda</a></li>
                        </ol>
                    </nav>
                </div>

                <div class="col-lg-6 d-flex justify-content-end align-items-center">
                    <div class="search-bar">
                        <form action="{{ route('map.index') }}" method="GET" class="search-form">
                            <div class="input-group rounded">
                                <input type="text" name="search" class="form-control" placeholder="Search"
                                    value="{{ request('search') }}">
                                <span class="input-group-text border-0" id="search-addon">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </form>
                    </div>
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
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Tumbuhan</th>
                                            <th scope="col">Kebun Raya</th>
                                            <th scope="col">Persebaran</th>
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
        var gardenArea = {!! json_encode($garden) !!};

        document.getElementById('confirmGarden').addEventListener('click', function() {
            var gardenSelect = document.getElementById('gardenSelect');
            var selectedGardenId = gardenSelect.options[gardenSelect.selectedIndex].value;
            var selectedGardenName = gardenSelect.options[gardenSelect.selectedIndex].text;

            if (selectedGardenName) {
                document.getElementById('selectGardenModal').style.display = 'none';
                document.getElementById('skeletonArea').style.display = 'none';
                document.getElementById('titleArea').style.display = 'block';
                document.getElementById('contentArea').style.display = 'block';
                document.getElementById('previewGardenArea').textContent = "Peta Pratinjau " + selectedGardenName;
                document.getElementById('pageTitle').textContent = "Legenda  " + selectedGardenName;

                console.log('Garden dipilih:', selectedGardenName);

                var map = L.map('map').setView([-6.7395, 107.0045], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                var gardenId = Array.isArray(gardenArea) ?
                    gardenArea.find(g => g.id == selectedGardenId) :
                    gardenArea;


                if (gardenId && gardenId.polygon) {
                    var polygonCoordinates = JSON.parse(gardenId.polygon);
                    console.log('Polygon Coordinates:', polygonCoordinates);

                    var polygon = L.polygon(polygonCoordinates, {
                        color: 'green',
                        fillColor: '#4CAF50',
                        fillOpacity: 0.5
                    }).addTo(map);

                    polygon.bindPopup("<b>Area Kebun Raya " + selectedGardenName + "</b>");
                } else {
                    alert('Polygon tidak ditemukan untuk kebun ini.');
                }

                var data = {!! json_encode($point) !!};

                data.forEach(function(item) {
                    var fotoRempah = '';
                    if (item.image) {
                        fotoRempah = '<img src="' + item.image + '" alt="' + item.nama_rempah +
                            '" class="img-fluid" style="max-width: 188px; height: auto; margin-bottom: 10px" />';
                    } else {
                        fotoRempah =
                            '<img src="http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg" alt="Foto Rempah" class="img-fluid" style="max-width: 188px; height: auto; margin-bottom: 10px" />';
                    }

                    var marker = L.marker([item.latitude, item.longitude]).addTo(map);
                    marker.bindPopup(
                        fotoRempah + "<br>" +
                        "<b> Nama Rempah: </b>" + item.nama_rempah + "<br>" +
                        "<b> Nama Latin: </b>" + item.nama_latin + "<br>" +
                        "<b> Kategori: </b>" + item.category_name + "<br>" +
                        "<b> Latitude: </b>" + item.latitude + "<br>" +
                        "<b> Longitude: </b>" + item.longitude + "<br>");
                });

            } else {
                alert('Silakan pilih Kebun Raya dulu.');
            }
        });
    </script>
@endsection
