<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-authenticated" content="{{ Auth::check() ? 'true' : 'false' }}">

    <title>@yield('title', config('app.name', 'App'))</title>

    <!-- Google Font: Inter (or your preferred font) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles and Scripts (managed by Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('styles') {{-- For page-specific styles --}}
</head>
<body>
    <header class="navbar">
        <div class="navbar-left">
            <a href="{{ route('home') }}"><img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="logo" style="height: 50px; width: auto;"></a>
        </div>
        <nav class="navbar-right">
            <ul>
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>
                <li><a href="{{ route('about.us') }}" class="{{ request()->routeIs('about.us') ? 'active' : '' }}">About Us</a></li>
            </ul>

            {{-- Dynamic Authentication Buttons based on actual login status --}}
            @auth {{-- If user is logged in --}}
                <div class="auth-buttons">
                    {{-- REMOVED: Profile button --}}
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-logout">Sign Out</button>
                    </form>
                </div>
            @else {{-- If user is NOT logged in --}}
                <div class="auth-buttons">
                    <a href="{{ route('register') }}" class="btn btn-signup">Sign Up</a>
                    <a href="{{ route('login') }}" class="btn btn-login">Log In</a>
                </div>
            @endauth
        </nav>
    </header>

    <main class="container">
        @yield('content') {{-- Main content of each page will be injected here --}}
    </main>

    {{-- START OF CONDITIONAL FOOTER --}}
    @unless(Route::currentRouteName() == 'home')
        <footer class="footer">
            <p>&copy; 2025 Global Currency Archive. All rights reserved.</p>
        </footer>
    @endunless
    {{-- END OF CONDITIONAL FOOTER --}}


    @yield('scripts') {{-- For page-specific scripts --}}
</body>
</html>
