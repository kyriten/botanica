@extends('welcome.master')

@section('formLogin')
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <div class="divider d-flex align-items-center my-4">
                        <h3 class="text-center fw-bold mx-3 mb-0">L O G I N</h3>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('loginError') }}
                            <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="container-wrapper position-relative">
                        <form action="{{ route('auth.login') }}" method="POST" id="login-form">
                            @csrf
                            <!-- Email input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" id="loginEmail"
                                    class="form-control form-control-lg @error('login_email') is-invalid @enderror"
                                    placeholder="Masukkan alamat email yang valid" name="login_email"
                                    value="{{ old('login_email') }}" required autofocus />
                                <label class="form-label" for="loginEmail">Email Kamu</label>
                                @error('login_email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password input -->
                            <div data-mdb-input-init class="form-outline mb-3">
                                <input type="password" id="loginPassword" class="form-control form-control-lg"
                                    name="login_password" placeholder="Masukkan kata sandi kamu" required />
                                <label class="form-label" for="loginPassword">Kata Sandi Kamu</label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Checkbox -->
                                <div class="form-check mb-0">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="loginCheck"
                                        checked />
                                    <label class="form-check-label" for="loginCheck">
                                        Ingetin saya udah masuk
                                    </label>
                                </div>
                                <a href="#!" class="text-primary">Duh! Aku, lupa kata sandinya</a>
                            </div>

                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;"
                                    id="login-button">{{ __('LOGIN') }}</button>
                            </div>
                        </form>

                        <!-- Overlay Loader -->
                        <div id="loader-overlay" class="loader-overlay d-none">
                            <div class="loader-content text-center">
                                <div class="spinner-border text-light" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-3 text-light">Memproses login, mohon tunggu...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
                Copyright © 2025. All rights reserved.
            </div>
            <!-- Copyright -->

            <!-- Right -->
            <div>
                <a href="#!" class="text-white me-4">
                    <i class="fa-solid fa-globe"></i> www.taksonomi-app.abiila.com
                </a>
            </div>
            <!-- Right -->
        </div>
    </section>
@endsection
