<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- CSRF token for forms --}}

    <title>@yield('title', config('app.name', 'Laravel'))</title> {{-- Dynamic page title --}}

    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles and Scripts (managed by Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page" style="font-family: 'Inter', sans-serif;"> {{-- Removed inline layout styles, added auth-page class. Keeping font-family inline for direct application. --}}
    {{-- This is the placeholder where your page-specific content (like login/register forms) will be injected --}}
    @yield('content')
</body>
</html>
