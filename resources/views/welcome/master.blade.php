<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di {{ config('app.name') }} </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet" /> --}}
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,400;1,500;1,700;1,800&display=swap"
        rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font.css') }}" rel="stylesheet">

    <link href="{{ asset('images/favicon.ico') }}" rel="icon">
</head>

<body class="bg-light-subtle bg-opacity-25">
    @yield('formLogin')

    <!-- FOOTER -->
    <script src="https://kit.fontawesome.com/f7402773f7.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
    {{-- <script src="{{ asset('js/mdb.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/mdb.es.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/mdb.umd.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/mdb.es.min.js.map') }}"></script>
    <script src="{{ asset('js/mdb.umd.min.js.map') }}"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('login-form');
            const loaderOverlay = document.getElementById('loader-overlay');
            const loginButton = document.getElementById('login-button');
            const containerWrapper = document.querySelector('.container-wrapper');

            form.addEventListener('submit', function(event) {
                // Prevent double submit
                loginButton.disabled = true;
                loginButton.innerHTML =
                    'Mohon tunggu... <span class="spinner-border spinner-border-sm ms-2"></span>';

                // Tampilkan loader overlay
                loaderOverlay.classList.remove('d-none');
                loaderOverlay.classList.add('active');

                // Tambahkan efek blur ke form
                containerWrapper.classList.add('loading');
            });
        });
    </script>
</body>

</html>
