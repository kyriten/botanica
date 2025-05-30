<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name') }} - @yield('title', 'Pencarian')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>

    <!-- Favicons -->
    <link href="{{ asset('images/favicon.ico') }}" rel="icon">

    <!-- Vendor CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Google Fonts (Opsional, mirip Google look) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search-landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .search-container {
            margin-top: 10vh;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        /* Efek redup saat hover */
        .image-hover:hover {
            filter: brightness(70%);
            transition: filter 0.3s ease;
        }


        /* Modal dark background override (optional aesthetic) */
        .modal-content {
            background-color: rgba(0, 0, 0, 0.85);
            border-radius: 1rem;
            overflow: hidden;
        }

        .modal-body img {
            max-height: 80vh;
        }

        @media (max-width: 767.98px) {
            .plant-latin {
                font-size: 14px !important;
            }

            .logo-botanica-mobile {
                height: 48px !important;
            }

            .title-botanica-mobile {
                font-size: 48px !important;
            }
        }

        @media (min-width: 992px) {
            .fs-desktop {
                font-size: 5rem !important;
            }
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
    </style>
</head>

<body>
    @yield('content')

    <script>
        window.routes = {
            autocomplete: "{{ route('plant.autocomplete') }}",
            search: "{{ route('public.search') }}"
        };
    </script>


    <!-- Vendor JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @stack('scriptPlantShow')

    <script src="{{ asset('js/search-landing.js') }}"></script>

</body>

</html>
