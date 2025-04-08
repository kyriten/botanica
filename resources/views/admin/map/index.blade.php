@extends('admin.app')
@section('post')
    <main class="main" id="main">
        <div class="pagetitle">
            <div class="row">
                <div class="col-lg-4">
                    <h1>Lihat Data Pin</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('map.index') }}">Peta</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('map.index') }}">Lihat Data Pin</a></li>
                        </ol>
                    </nav>
                </div>

                <div class="col-lg-8 d-flex justify-content-end align-items-center">
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

        <section class="section">
            <div class="row">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="col-lg-12">
                    <div class="mb-3" id="map" style="height: 500px; width: 100%"></div>
                </div>
                <script>
                    var map = L.map('map').setView([1.2448327, 120.830595], 5);

                    var tiles = L.tileLayer(
                        'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
                            attribution: '&copy; Esri'
                        }).addTo(map);


                    // Script untuk menampilkan marker dari data
                    var data = {!! json_encode($point) !!}; // Masukkan data dari controller

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

                    // Fungsi untuk menambahkan marker saat formulir dikirim
                    // document.getElementById('addMarkerForm').addEventListener('submit', function(e) {
                    //     e.preventDefault();

                    //     var namaRempah = document.querySelector('input[name="nama_rempah"]').value;
                    //     var latitude = document.querySelector('input[name="latitude"]').value;
                    //     var longitude = document.querySelector('input[name="longitude"]').value;

                    //     // Validasi input, pastikan data sudah sesuai
                    //     if (namaRempah && latitude && longitude) {
                    //         L.marker([parseFloat(latitude), parseFloat(longitude)])
                    //             .addTo(map)
                    //             .bindPopup(namaRempah) // Tampilkan informasi nama rempah di dalam marker
                    //             .openPopup();
                    //     } else {
                    //         alert('Harap isi semua field');
                    //     }
                    // });
                </script>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Kebun Raya</th>
                                            <th scope="col">Kota/Kabupaten</th>
                                            <th scope="col">Provinsi</th>
                                            <th scope="col">Persebaran</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($map as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->garden_name }}</td>
                                                <td>{{ $item->city_name }}</td>
                                                <td>{{ $item->province_name }}</td>
                                                <td>{{ $item->local }}</td>
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
            </div>
        </section>
    </main><!-- End #main -->
@endsection
