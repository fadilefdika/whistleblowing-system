<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVI Whistleblowing System</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="d-flex flex-column min-vh-100">

    <main class="flex-fill">
        @yield('content')
    </main>

    <footer class="bg-light text-center py-3">
        <small>&copy; {{ date('Y') }} PT Astra Visteon Indonesia</small>
    </footer>

    @yield('scripts')
</body>
</html>
