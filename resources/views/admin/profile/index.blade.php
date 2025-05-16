@extends('admin.app')

@section('profile')
    <main class="main" id="main">

        <!-- Header: Avatar & Username -->
        <div class="text-center mb-4">
            <img src="{{ asset('images/no-avatar.jpg') }}" alt="Avatar" class="rounded-circle mb-2" width="100"
                height="100">
            <h5 class="mb-1">{{ Auth::user()->username }}</h5>
            <p class="text-muted small mb-0">{{ Auth::user()->email }}</p>
        </div>

        <!-- Informasi Akun -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body">
                <h6 class="card-title mb-3 text-uppercase text-muted" style="font-size: 0.85rem;">Informasi Akun</h6>
                <ul class="list-unstyled mb-3">
                    <li class="mb-2"><strong>Nama:</strong> {{ Auth::user()->username }}</li>
                    <li class="mb-2"><strong>Email:</strong> {{ Auth::user()->email }}</li>
                    <li><strong>Terdaftar sejak:</strong>
                        {{ optional(Auth::user()->created_at)->format('d M Y') ?? 'Tidak ada data' }}</li>
                </ul>

                <!-- Tombol Aksi -->
                <div class="col-auto mb-0">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100
">
                            <i class="bi bi-box-arrow-right me-1"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>


    </main>
@endsection
