<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

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

    <style>
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
            background-color: #fff3cd;
            /* Light yellow */
            color: #856404;
            /* Dark yellow text */
            padding: 0.25rem 0.5rem;
            border-left: 4px solid #ffc107;
            /* Yellow border */
            border-radius: 0.25rem;
            display: inline-block;
            font-size: 0.875rem;
        }
    </style>

    {{-- IconScout --}}
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>

<body>

    @include('admin.partials.header')
    @include('admin.partials.sidebar')
    @yield('dashboard')
    @yield('post')
    @yield('dbProvinsi')
    @yield('dbCity')
    @yield('dbDistrict')
    @yield('dbVillage')
    @include('admin.partials.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('admin.post.feature.image')
    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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


    {{-- AJAX Generate Slug Posts --}}
    <script>
        const namarempah = document.querySelector('.namarempah');
        const slug = document.querySelector('#slug');

        namarempah.addEventListener('change', function() {
            fetch('/posts/checkSlug?namarempah=' + namarempah.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug);
        });
    </script>

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

    {{-- AJAX Generate Category --}}
    <script>
        $(document).ready(function() {
            $('#category').on('change', function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '/get-category-details/' + categoryId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data) {
                                $('#category_name').val(data.name);
                            } else {
                                $('#category_name').val('');
                            }
                        }
                    });
                } else {
                    $('#category_name').val('');
                }
            });
        });
    </script>

    {{-- AJAX Generate Nama Rempah --}}
    <script>
        $(document).ready(function() {
            $('#rempah').on('change', function() {
                var namarempahId = $(this).val();
                if (namarempahId) {
                    $.ajax({
                        url: '/get-rempah-details/' + namarempahId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data) {
                                $('#nama_rempah').val(data.nama_rempah);
                                $('#nama_latin').val(data.nama_latin);
                                $('#category_id').val(data.category_id);
                                $('#category_name').val(data.category_name);
                            } else {
                                $('#nama_rempah').val('');
                                $('#nama_latin').val('');
                                $('#category_id').val('');
                                $('#category_name').val('');
                            }
                        }
                    });
                } else {
                    $('#nama_rempah').val('');
                    $('#nama_latin').val('');
                    $('#category_id').val('');
                    $('#category_name').val('');
                }
            });
        });
    </script>

    {{-- Select2 via CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').each(function() {
                let placeholder = $(this).data('placeholder') || 'Silakan pilih';
                $(this).select2({
                    placeholder: placeholder,
                    allowClear: true,
                    width: '100%',
                    minimumResultsForSearch: 0
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Ketika pilih Kota
            $('#cityID').on('change', function() {
                var cityId = $(this).val();

                if (cityId) {
                    $.ajax({
                        url: '/get-province/' + cityId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data.province) {
                                $('#provinceID').val(data.province);
                            } else {
                                $('#provinceID').val('Provinsi tidak ditemukan');
                            }
                        },
                        error: function() {
                            $('#provinceID').val('Terjadi kesalahan');
                        }
                    });
                } else {
                    $('#provinceID').val('');
                }
            });

            // Ketika pilih Kecamatan
            $('#districtID').on('change', function() {
                var districtId = $(this).val();

                if (districtId) {
                    $.ajax({
                        url: '/get-city/' + districtId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data.city) {
                                $('#cityID').val(data.city);
                            } else {
                                $('#cityID').val('Kota tidak ditemukan');
                            }
                        },
                        error: function() {
                            $('#cityID').val('Terjadi kesalahan');
                        }
                    });
                } else {
                    $('#cityID').val('');
                }
            });
        });
    </script>
</body>

</html>
