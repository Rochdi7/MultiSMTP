<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MultiSMTP Mailer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS (Optional for quick styling) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f9fafb;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            background-color: #1E3A8A;
        }
        .navbar-brand, .nav-link, .text-white {
            color: #fff !important;
        }
        .container {
            margin-top: 40px;
        }
        footer {
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            background-color: #1E3A8A;
            color: #fff;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('mail.form') }}">MultiSMTP</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mail.form') }}">Send Mail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mail.dashboard') }}">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        &copy; {{ date('Y') }} MultiSMTP Mailer System. All rights reserved.
    </footer>

    <!-- Optional JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
