<!DOCTYPE html>
<html lang="en" class="login-html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/table.svg')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
    <title>QuickTable | Welcome back</title>
</head>
<body class="login-body">
    <header class="index-header">
        <h1 class="login-h1">Quick<img src="assets/table.svg" class="table-icon" alt="">able</h1>
        <div class="logins">
            <button class="log" onclick="window.location.href = '/login?login'">Login</button>
            <button class="log" onclick="window.location.href = '/login?register'">Register</button>
        </div>
    </header>
    @yield('content')
    <footer class="login-footer">
        <p>&copy; {{ date('Y') }} Quicktable. All rights reserved.</p>
    </footer>
</body>
</html>
<script src="/js/script.js?v1.2" defer></script>{{--7614--}}