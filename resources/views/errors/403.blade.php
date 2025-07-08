<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>403 Forbidden</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .error-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }

        .error-code {
            font-size: 10rem;
            font-weight: bold;
            color: #dc3545;
        }

        .error-message {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>

    <div class="error-container">
        <div class="error-code">403</div>
        <div class="error-message">Akses Ditolak</div>
        <p class="text-muted">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
        <a href="/" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>

</body>

</html>
