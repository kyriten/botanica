@extends('admin.app')
@section('post')
    <main class="main" id="main">

        <div class="pagetitle">
            <h1>Add New Post</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('post.create') }}">Posts</a></li>
                    <li class="breadcrumb-item active">Add Post</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{-- Upload Image --}}
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">

                                {{-- Image --}}
                                <h5 class="card-title fs-4 mb-0 pb-2">Upload Gambar
                                    <br>
                                    <p class="text-secondary mt-2 mb-3 textf-justify" style="font-size: 14px">Hanya gambar
                                        yang dapat
                                        diupload. <br> Mohon
                                        upload
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
                                        @error('foto_rempah')
                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <div class="btn btn-primary btn-rounded">
                                            <label class="form-label text-white m-1" for="customFile1">Choose file</label>
                                            <input
                                                class="imgPreview form-control d-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('foto_rempah') is-invalid @enderror"
                                                id="customFile1" name="foto_rempah" type="file"
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
                                <h5 class="card-title fs-4">Entry Data</h5>

                                <!-- Detail Post Form -->
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label text-dark" style="font-size: 14px">Nama
                                        Rempah</label>
                                    <div class="col-sm-10">
                                        <div class="form-floating mb-3">
                                            <input class="form-control namarempah @error('nama_rempah')is-invalid @enderror"
                                                name="nama_rempah" type="text" id="floatingInput"
                                                value="{{ old('nama_rempah') }}" placeholder="Masukkan Nama Rempah" required
                                                autofocus>
                                            <label for="floatingInput" class="text-secondary">Masukkan Nama
                                                Rempah</label>
                                            @error('nama_rempah')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label text-dark" style="font-size: 14px">Slug</label>
                                    <div class="col-sm-10">
                                        <input class="form-control @error('slug')is-invalid @enderror" name="slug"
                                            type="text" id="slug" disabled>
                                        @error('nama_rempah')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label text-dark" style="font-size: 14px">Nama
                                        Latin</label>
                                    <div class="col-sm-10">
                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('nama_latin')is-invalid @enderror"
                                                id="floatingInput" name="nama_latin" type="text"
                                                value="{{ old('nama_latin') }}" placeholder="Masukkan Nama Latin Rempah"
                                                required>
                                            <label for="floatingInput" class="text-secondary">Masukkan Nama Latin
                                                Rempah</label>
                                            @error('nama_latin')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label text-dark"
                                        style="font-size: 14px">Kategori</label>
                                    <div class="col-sm-10 mb-3">
                                        <select class="form-select" aria-label="Default select example" name="category_id"
                                            id="category">
                                            <option>Pilih Kategori</option>
                                            @foreach ($category as $key)
                                                <option value="{{ $key->id }}">
                                                    {{ $key->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('name')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Nama Kategori</label>
                                    <div class="col-sm-10 mb-3">
                                        <input class="form-control" type="text" name="category_name" id="category_name"
                                            value="{{ old('category_name') }}" readonly>
                                    </div>
                                </div>
                                <!-- End General Form Elements -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 w-full">
                        <div class="card">
                            <div class="card-body">
                                <!-- Detail Post Form -->
                                <div class="row mt-5 mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label text-dark"
                                        style="font-size: 14px">Khasiat</label>
                                    <div class="col-sm-10">
                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('khasiat')is-invalid @enderror"
                                                id="floatingInput" name="khasiat" type="text"
                                                value="{{ old('khasiat') }}" placeholder="Masukkan Khasiat Rempah"
                                                required>
                                            <label for="floatingInput" class="text-secondary">Masukkan Khasiat
                                                Rempah</label>
                                            @error('khasiat')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label text-dark" style="font-size: 14px">Dosis</label>
                                    <div class="col-sm-10">
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control @error('dosis')is-invalid @enderror" id="floatingInput" name="dosis"
                                                placeholder="Masukkan Dosis" rows="5" required></textarea>
                                            <label for="floatingInput" class="text-secondary">Masukkan Dosis</label>
                                            @error('dosis')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label text-dark"
                                        style="font-size: 14px">Mekanisme</label>
                                    <div class="col-sm-10">
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control @error('mekanisme')is-invalid @enderror" id="floatingInput" name="mekanisme"
                                                placeholder="Masukkan Mekanisme" rows="5" required></textarea>
                                            <label for="floatingInput" class="text-secondary">Masukkan Mekanisme</label>
                                            @error('mekanisme')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label text-dark" style="font-size: 14px">Dapus</label>
                                    <div class="col-sm-10">
                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('dapus')is-invalid @enderror"
                                                id="floatingInput" name="dapus" type="text"
                                                value="{{ old('dapus') }}" placeholder="Masukkan Dapus Rempah" required>
                                            <label for="floatingInput" class="text-secondary">Masukkan Dapus
                                                Rempah</label>
                                            @error('dapus')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label text-dark" style="font-size: 14px">Link</label>
                                    <div class="col-sm-10">
                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('link')is-invalid @enderror"
                                                id="floatingInput" name="link" type="text"
                                                value="{{ old('link') }}" placeholder="Masukkan Link Rempah" required>
                                            <label for="floatingInput" class="text-secondary">Masukkan Link
                                                Rempah</label>
                                            @error('link')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
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
        </section>
    </main><!-- End #main -->
@endsection
