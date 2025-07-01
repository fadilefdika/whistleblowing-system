<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVI Whistleblowing System</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font Awesome (untuk icon mata dan lainnya) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-dIe7N3r3FEfBxEFU3gA3zUeW7a2eP4hU8+nXK8NnhDoH8Jd9n9hZgAsYB2+gkU+pQ5HKthkNQoj+2CgP8r1zKg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body class="d-flex flex-column min-vh-100">


    <main class="flex-fill">
        @yield('content')
    </main>

    <footer class="bg-light text-center py-3">
        <small>&copy; {{ date('Y') }} PT Astra Visteon Indonesia</small>
    </footer>

    @stack('scripts')
</body>
</html>
