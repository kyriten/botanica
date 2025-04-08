@extends('admin.app')

@section('viewData')
    <main id="main" class="main">
        <div class="pagetitle">
            <div class="row">
                <div class="col-lg-4">
                    <h1>Tabel Data Rempah Nusantara</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a>Posts</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('post.index') }}">View Data Post</a></li>
                            <li class="breadcrumb-item active">Data Table</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-lg-8 d-flex justify-content-end align-items-center">
                    <div class="search-bar">
                        <form action="{{ route('post.index') }}" method="GET" class="search-form">
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
                <div class="col-lg-12">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Rempah</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Foto Rempah</th>
                                            <th scope="col">Khasiat</th>
                                            <th scope="col">Dosis</th>
                                            <th scope="col">Mekanisme</th>
                                            <th scope="col">Dapus</th>
                                            <th scope="col">Link</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($posts as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_rempah }} <b>({{ $item->nama_latin }})</b></td>
                                                <td>{{ $item->category->name }}</td>
                                                <td>
                                                    @if ($item->foto_rempah)
                                                        <img src="{{ asset('storage/' . $item->foto_rempah) }}"
                                                            alt="{{ $item->nama_rempah }}" class="img-fluid"
                                                            style="max-width: 188px; height: auto;" />
                                                    @else
                                                        <img src="http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg"
                                                            alt="Foto Rempah" class="img-fluid"
                                                            style="max-width: 188px; height: auto;" />
                                                    @endif
                                                </td>
                                                <td>{{ $item->khasiat }}</td>
                                                <td>{{ $item->dosis }}</td>
                                                <td>{{ $item->mekanisme }}</td>
                                                <td>{{ $item->dapus }}</td>
                                                <td>{{ $item->link }}</td>
                                                <td>
                                                    <div class="d-flex gap-3">
                                                        <a class="btn btn-warning" href="/post/{{ $item->slug }}/edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('post.destroy', $item->slug) }}"
                                                            method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger"
                                                                onclick="return confirm('Are you sure to delete your post?')">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="12" class="text-center">No record available here
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <!-- Bagian untuk menampilkan tautan paginate -->
                                </table>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item">{{ $posts->links() }}</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End main -->
@endsection
