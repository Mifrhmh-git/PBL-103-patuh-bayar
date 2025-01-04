<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">
    <title>@yield('title', 'Notification')</title>
</head>
<body>
    @yield('content')

    @if(session('pesan'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
    <script>
        Swal.fire({
            title: 'Notifikasi!',
            text: {!! json_encode(session('pesan')) !!},
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
    @endif
</body>
</html>
