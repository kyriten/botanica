<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard - {{ config('app.name') }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>

    <!-- Favicons -->
    <link href="{{ asset('images/favicon.ico') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Template POST CSS File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/image-form.css') }}" rel="stylesheet">

    <style>
        .btn.dropdown-toggle.no-arrow::after {
            display: none;
        }

        /* Animasi tombol saat diklik */
        #mobile-bottom-bar .small {
            transition: transform 0.2s ease-in-out, background-color 0.2s ease, color 0.2s ease;
        }

        /* Efek saat tombol ditekan (klik) */
        #mobile-bottom-bar .small:active {
            transform: scale(0.75);
            /* Membuat tombol sedikit mengecil saat ditekan */
        }

        /* Jika tombol aktif, beri animasi scaling dan perubahan warna */
        #mobile-bottom-bar .fw-bold {
            transform: scale(1.05);
            /* Membesarkan tombol saat aktif */
        }

        .bg-custom {
            background-color: #626f47;
            color: #ffffff;
        }

        .table th:nth-child(1),
        .table td:nth-child(1) {
            width: 5%;
        }

        .table th:nth-child(2),
        .table td:nth-child(2) {
            width: 12%;
        }

        .table th:nth-child(3),
        .table td:nth-child(3) {
            width: 12%;
        }

        .table th:nth-child(4),
        .table td:nth-child(4) {
            width: 20%;
        }

        .table th:nth-child(5),
        .table td:nth-child(5) {
            width: 10%;
        }

        .table th:nth-child(6),
        .table td:nth-child(6) {
            width: 25%;
        }

        .table th:nth-child(7),
        .table td:nth-child(7) {
            width: 10%;
        }

        .dashboard .total-card .card-icon {
            color: #013e70;
            background: #B3D4E8;
        }

        .dashboard .category1-card .card-icon {
            color: #e4a906;
            background: #fbe8a6;
        }

        .dashboard .category2-card .card-icon {
            color: #e23838;
            background: #fde2e2;
        }

        .dashboard .category3-card .card-icon {
            color: #ca6c2e;
            background: #f1c4a8;
        }

        .dashboard .category4-card .card-icon {
            color: #75350d;
            background: #ddbba8;
        }

        .note-flag {
            background-color: #e6ebe0;
            /* Sage green light */
            color: #4b6043;
            /* Sage green dark text */
            padding: 0.25rem 0.5rem;
            border-left: 4px solid #94a98a;
            /* Medium sage green border */
            border-radius: 0.25rem;
            display: inline-block;
            font-size: 0.875rem;
        }

        /* Skeleton Loading */
        .skeleton {
            background-color: #e2e5e7;
            background-image: linear-gradient(90deg, #e2e5e7, #f8f8f8, #e2e5e7);
            background-size: 200% 100%;
            background-position: -50% 0;
            animation: shimmer 1.5s infinite;
            border-radius: 8px;
        }

        @keyframes shimmer {
            100% {
                background-position: 100% 0;
            }
        }

        /* Animasi Fade In */
        .fade-in {
            animation: fadeIn 1s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        /* Toggle search input - mobile responsive */
        #searchInput {
            display: none;
        }

        .toggle-search {
            transition: max-width 0.4s ease;
            max-width: 45px;
            overflow: hidden;
            flex-wrap: nowrap;
        }


        .toggle-search.expanded {
            max-width: 100%;
        }

        .toggle-search.expanded #searchInput {
            display: block;
        }

        @media (min-width: 768px) {
            .toggle-search {
                max-width: 100% !important;
            }

            #searchInput {
                display: block !important;
            }
        }

        .input-group-text {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .input-group .form-control,
        .input-group .input-group-text {
            height: 38px;
            font-size: 0.875rem;
        }

        @media (max-width: 768px) {

            table,
            table td,
            table th {
                font-size: 12px !important;
            }
        }

        @media (max-width: 767.98px) {
            /* Kolom header "Aksi" */
            th.action-col {
                font-size: 12px !important;
                width: 30px !important;
                /* custom width untuk header */
                padding: 0.3rem 0.5rem !important;
                white-space: nowrap;
                /* supaya gak pecah baris */
            }

            /* Kolom isi "Aksi" */
            td.action-col {
                font-size: 12px !important;
                width: 30px !important;
                /* custom width untuk cell */
                padding: 0.3rem 0.5rem !important;
                white-space: nowrap;
            }
        }
    </style>

    {{-- IconScout --}}
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    @stack('styles')
</head>

<body>

    @include('admin.partials.header')
    @include('admin.partials.sidebar')
    @include('admin.partials.bottombar')
    @yield('dashboard')
    @yield('post')
    @yield('profile')
    @yield('dbProvinsi')
    @yield('dbCity')
    @yield('dbDistrict')
    @yield('dbVillage')
    {{-- @include('admin.partials.footer') --}}

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('admin.post.feature.image')

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>

    {{-- AJAX Generate Lat and Long of City and Province --}}
    <script>
        $(document).ready(function() {
            $('#cityID').on('change', function() {
                var cityId = $(this).val();

                if (cityId) {
                    $.ajax({
                        url: '/get-city-details/' + cityId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data) {
                                // Set lat & long city
                                $('#latCity').val(data.latitude);
                                $('#longCity').val(data.longitude);

                                // Set province ID
                                if (data.province_id) {
                                    $('#provinceID').val(data.province_id).trigger('change');
                                }
                            } else {
                                $('#latCity').val('');
                                $('#longCity').val('');
                                $('#provinceID').val('').trigger('change');
                            }
                        },
                        error: function() {
                            alert('Gagal mengambil data kota.');
                        }
                    });
                } else {
                    $('#latCity').val('');
                    $('#longCity').val('');
                    $('#provinceID').val('').trigger('change');
                }
            });

            $('#provinceID').on('change', function() {
                var provinceId = $(this).val();

                if (provinceId) {
                    $.ajax({
                        url: '/get-province-details/' + provinceId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data) {
                                $('#latProvince').val(data.latitude);
                                $('#longProvince').val(data.longitude);
                            } else {
                                $('#latProvince').val('');
                                $('#longProvince').val('');
                            }
                        },
                        error: function() {
                            alert('Gagal mengambil data provinsi.');
                        }
                    });
                } else {
                    $('#latProvince').val('');
                    $('#longProvince').val('');
                }
            });
        });
    </script>


    {{-- AJAX Generate Name of Province --}}
    <script>
        $(document).ready(function() {
            $('#provinsi').on('change', function() {
                var provinsiId = $(this).val();
                if (provinsiId) {
                    $.ajax({
                        url: '/get-state-details/' + provinsiId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data) {
                                $('#nama_provinsi').val(data.name);
                            } else {
                                $('#nama_provinsi').val('');
                            }
                        }
                    });
                } else {
                    $('#nama_provinsi').val('');
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggle = document.getElementById("searchToggle");
            const container = document.getElementById("searchContainer");
            const input = document.getElementById("searchInput");

            toggle.addEventListener("click", function(e) {
                e.preventDefault(); // hindari submit tak sengaja
                container.classList.toggle("expanded");

                // fokus ke input jika ditampilkan
                setTimeout(() => {
                    if (container.classList.contains("expanded")) {
                        input.focus();
                    }
                }, 300);
            });
        });

        document.addEventListener("click", function(event) {
            const toggle = document.getElementById("searchToggle");
            const container = document.getElementById("searchContainer");

            if (!container.contains(event.target)) {
                container.classList.remove("expanded");
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
