@extends('admin.app')
@section('post')
    <main class="main" id="main">

        <div class="pagetitle">
            <h1>Edit Point </h1>
            <p>{{ $map->nama_rempah }} di {{ $map->name }}</p>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('map.index') }}">View Map</a></li>
                    <li class="breadcrumb-item active">Edit Point</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <form action="{{ route('map.update', $map->id) }}" method="post" enctype="multipart/form-data">
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
                                        @if ($map->image)
                                            <img id="imgPreview" src="{{ asset('storage/' . $map->image) }}"
                                                alt="image placeholder" style="width: 300px;" />
                                        @else
                                            <img id="imgPreview"
                                                src="http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large.jpg"
                                                alt="image placeholder" style="width: 300px;" />
                                        @endif
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
                                <h5 class="card-title fs-4">Edit Data</h5>

                                <!-- Detail Point Form -->
                                <!-- Nama Rempah -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Nama
                                        Rempah</label>
                                    <div class="col-sm-10 mb-3">
                                        <select class="form-select" aria-label="Default select example" name="post_id"
                                            id="rempah">
                                            <option>Pilih Nama Rempah</option>
                                            @foreach ($post as $key)
                                                @if (old('post_id', $map->post_id) == $key->id)
                                                    <option value="{{ $key->id }}" selected>
                                                        {{ $key->nama_rempah }}
                                                    </option>
                                                @else
                                                    <option value="{{ $key->id }}">
                                                        {{ $key->nama_rempah }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('nama_rempah')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Menyimpan Nama Rempah -->
                                <div class="row mb-3" hidden>
                                    <label class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Nama Rempah</label>
                                    <div class="col-sm-10 mb-3">
                                        <input class="form-control" type="text" name="nama_rempah" id="nama_rempah"
                                            value="{{ old('nama_rempah', $map->nama_rempah) }}" readonly>
                                    </div>
                                </div>

                                <!-- Menyimpan Nama Latin -->
                                <div class="row mb-3" hidden>
                                    <label class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Nama Latin</label>
                                    <div class="col-sm-10 mb-3">
                                        <input class="form-control" type="text" name="nama_latin" id="nama_latin"
                                            value="{{ old('nama_latin', $map->nama_latin) }}" readonly>
                                    </div>
                                </div>

                                <!-- Menyimpan Id Kategori -->
                                <div class="row mb-3" hidden>
                                    <label class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Kategori</label>
                                    <div class="col-sm-10 mb-3">
                                        <input class="form-control" type="text" name="category_id" id="category_id"
                                            value="{{ old('category_id', $map->category_id) }}" readonly>
                                    </div>
                                </div>

                                <!-- Menyimpan Nama Kategori -->
                                <div class="row mb-3" hidden>
                                    <label class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Nama Kategori</label>
                                    <div class="col-sm-10 mb-3">
                                        <input class="form-control" type="text" name="category_name" id="category_name"
                                            value="{{ old('category_name', $map->category_name) }}" readonly>
                                    </div>
                                </div>

                                <!-- Provinsi -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Provinsi</label>
                                    <div class="col-sm-10 mb-3">
                                        <select class="form-select" aria-label="Default select example" name="state_id"
                                            id="provinsi">
                                            <option>Pilih Provinsi</option>
                                            @foreach ($state as $key)
                                                @if (old('state_id', $map->state_id) == $key->id)
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
                                        @error('name')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Menyimpan Nama Provinsi -->
                                <div class="row mb-3" hidden>
                                    <label class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Nama Provinsi</label>
                                    <div class="col-sm-10 mb-3">
                                        <input class="form-control" type="text" name="name" id="nama_provinsi"
                                            value="{{ old('name', $map->name) }}">
                                    </div>
                                </div>

                                <!-- Latitude -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Latitude</label>
                                    <div class="col-sm-10 mb-3">
                                        <input class="form-control" type="text" name="latitude" id="latitude"
                                            value="{{ old('latitude', $map->latitude) }}" readonly>
                                    </div>
                                </div>

                                <!-- Longitude -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label text-dark align-items-center"
                                        style="font-size: 14px">Longitude</label>
                                    <div class="col-sm-10 mb-3">
                                        <input class="form-control" type="text" name="longitude" id="longitude"
                                            value="{{ old('longitude', $map->longitude) }}" readonly>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button class="btn btn-secondary fw-bold text-primary" id="reset"
                                        type="reset">{{ __('RESET') }}</button>
                                    <button class="btn btn-primary fw-bold text-light" id="submit"
                                        type="submit">{{ __('SAVE') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main><!-- End #main -->
@endsection
