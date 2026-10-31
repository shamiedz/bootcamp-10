<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Dhimson E-Store') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 text-gray-800 antialiased min-h-screen flex flex-col justify-between">

        <!-- Header / Navbar -->
        <header class="w-full bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <!-- Store Logo -->
                <a href="{{ url('/') }}" class="font-black text-2xl tracking-wider text-gray-900">
                    DHIMSON <span class="text-orange-500">E-STORE</span>
                </a>

                <!-- Breeze Navigation Links -->
                @if (Route::has('login'))
                    <nav class="flex items-center gap-3">
                        <a href="{{ url('/products') }}" class="text-sm font-medium text-gray-600 hover:text-orange-500 px-3 py-2">
                            Product Catalog
                        </a>

                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow-sm transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 hover:border-gray-400 text-gray-700 text-sm font-medium rounded-md transition">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-md shadow-sm transition">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <!-- Hero Section -->
        <main class="flex-1 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl w-full text-center">
                <span class="inline-block px-3 py-1 text-xs font-semibold uppercase tracking-wider text-orange-600 bg-orange-100 rounded-full mb-4">
                    Official Online Store
                </span>
                
                <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 tracking-tight leading-tight mb-4">
                    Welcome to <span class="text-orange-500">Dhimson E-Store</span>
                </h1>
                
                <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">
                    Discover quality products at affordable prices. Sign in to start shopping or access your account through the dashboard.
                </p>

                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ url('/products') }}" class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition">
                        Shop Now
                    </a>

                    @guest
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-3 bg-white hover:bg-gray-100 text-gray-800 font-semibold border border-gray-300 rounded-lg shadow-sm transition">
                                Create Account
                            </a>
                        @endif
                    @else
                        <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-white hover:bg-gray-100 text-gray-800 font-semibold border border-gray-300 rounded-lg shadow-sm transition">
                            Open Dashboard
                        </a>
                    @endguest
                </div>

                <!-- Feature Highlights -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-16 text-left">
                    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="w-10 h-10 flex items-center justify-center bg-orange-100 text-orange-600 rounded-lg font-bold mb-3">
                            1
                        </div>
                        <h3 class="font-bold text-gray-900 mb-1">Product Catalog</h3>
                        <p class="text-sm text-gray-500">Explore our comprehensive catalog connected directly to the database.</p>
                    </div>

                    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="w-10 h-10 flex items-center justify-center bg-orange-100 text-orange-600 rounded-lg font-bold mb-3">
                            2
                        </div>
                        <h3 class="font-bold text-gray-900 mb-1">User Accounts</h3>
                        <p class="text-sm text-gray-500">Secure user registration and authentication powered by Laravel Breeze.</p>
                    </div>

                    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="w-10 h-10 flex items-center justify-center bg-orange-100 text-orange-600 rounded-lg font-bold mb-3">
                            3
                        </div>
                        <h3 class="font-bold text-gray-900 mb-1">Dashboard Panel</h3>
                        <p class="text-sm text-gray-500">Dedicated management area accessible once you are signed in.</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="w-full bg-white border-t border-gray-200 py-6 text-center text-sm text-gray-500">
            &copy; 2026 {{ config('app.name', 'Dhimson E-Store') }}. All rights reserved.
        </footer>

    </body>
</html>