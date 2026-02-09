<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Scripts -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'IzaMarizShop')</title>
    <script>
        window.successMessage = @json(session('success'));
        window.errorMessage = @json(session('error'));
        window.infoMessage = @json(session('info'));
        window.warningMessage = @json(session('warning'));
    </script>

</head>

<body>

    <div className='flex flex-col min-h-screen'>
        @include('mainlayouts.header')
        @yield('content')
        @include('mainlayouts.footer')
    </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/sweet-alert-handler.js') }}"></script>
</body>

</html>
