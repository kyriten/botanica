@extends('admin.app')
@section('post')
    <main class="main" id="main">

        <div class="pagetitle">
            <h1>Edit {{ $post->nama_rempah }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a>Posts</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('post.index') }}">View Data Post</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Data Table</a></li>
                    <li class="breadcrumb-item active">Edit Post</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <form action="{{ route('post.update', $post->slug) }}" method="post" enctype="multipart/form-data">
                @method('put')
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
                                        @if ($post->foto_rempah)
                                            <img id="imgPreview" src="{{ asset('storage/' . $post->foto_rempah) }}"
                                                alt="image placeholder" style="width: 300px;" />
                                        @else
                                            <img id="imgPreview"
                                                src="http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg"
                                                alt="image placeholder" style="width: 300px;" />
                                        @endif
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
                                <h5 class="card-title fs-4">Edit Data</h5>

                                <!-- Detail Post Form -->
                                <div class="row mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label text-dark" style="font-size: 14px">Nama
                                        Rempah</label>
                                    <div class="col-sm-10">
                                        <div class="form-floating">
                                            <input
                                                class="form-control namarempah @error('nama_rempah') is-invalid @enderror"
                                                id="floatingInput" name="nama_rempah" type="text"
                                                value="{{ old('nama_rempah', $post->nama_rempah) }}"
                                                placeholder="Masukkan Nama Rempah" required autofocus>
                                            <label for="floatingInput" class="text-secondary">Masukkan Nama Rempah</label>
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
                                        <input class="form-control @error('slug') is-invalid @enderror" name="slug"
                                            type="text" id="slug" value="{{ old('slug', $post->slug) }}"
                                            placeholder="Masukkan Slug" disabled>
                                        @error('slug')
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
                                        <div class="form-floating">
                                            <input class="form-control @error('nama_latin') is-invalid @enderror"
                                                id="floatingInput" name="nama_latin" type="text"
                                                value="{{ old('nama_latin', $post->nama_latin) }}"
                                                placeholder="Masukkan Nama Latin Rempah" required>
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
                                    <div class="col-sm-10">
                                        <select class="form-select @error('category') is-invalid @enderror"
                                            aria-label="Default select example" name="category_id" id="category">
                                            <option>Pilih Kategori</option>
                                            @foreach ($category as $key)
                                                @if (old('category_id', $post->category_id) == $key->id)
                                                    <option value="{{ $key->id }}" selected>
                                                        {{ $key->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $key->id }}">
                                                        {{ $key->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Menyimpan Nama Kategori -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Nama Kategori</label>
                                    <div class="col-sm-10 mb-3">
                                        <input class="form-control" type="text" name="category_name"
                                            id="category_name" value="{{ old('category_name', $post->category_name) }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 w-full">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mt-5 mb-3 align-items-center">
                                    <label class="col-sm-2 col-form-label text-dark"
                                        style="font-size: 14px">Khasiat</label>
                                    <div class="col-sm-10">
                                        <div class="form-floating">
                                            <input class="form-control @error('khasiat') is-invalid @enderror"
                                                id="floatingInput" name="khasiat" type="text"
                                                value="{{ old('khasiat', $post->khasiat) }}"
                                                placeholder="Masukkan Khasiat Rempah" required>
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
                                        <div class="form-floating">
                                            <textarea class="form-control @error('dosis') is-invalid @enderror" id="floatingInput" name="dosis"
                                                placeholder="Masukkan Dosis" rows="5" required>{{ old('dosis', $post->dosis) }}</textarea>
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
                                        <div class="form-floating">
                                            <textarea class="form-control @error('mekanisme') is-invalid @enderror" id="floatingInput" name="mekanisme"
                                                placeholder="Masukkan Mekanisme" rows="5" required>{{ old('mekanisme', $post->mekanisme) }}</textarea>
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
                                        <div class="form-floating">
                                            <textarea class="form-control @error('dapus') is-invalid @enderror" id="floatingInput" name="dapus" type="text"
                                                placeholder="Masukkan Dapus" required>{{ old('dapus', $post->dapus) }}</textarea>
                                            <label for="floatingInput" class="text-secondary">Dapus</label>
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
                                        <div class="form-floating">
                                            <input class="form-control @error('link') is-invalid @enderror"
                                                id="floatingInput" name="link" type="text"
                                                value="{{ old('link', $post->link) }}" placeholder="Masukkan Link"
                                                required>
                                            <label for="floatingInput" class="text-secondary">Link</label>
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
