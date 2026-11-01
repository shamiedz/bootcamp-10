<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DHIMSON E-STORE - Discover Premium Collections</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS (via Vite or CDN Fallback) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans flex flex-col min-h-screen">

    <!-- Top Navigation Bar -->
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Brand Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="font-black text-xl tracking-wider text-gray-900">
                        DHIMSON <span class="text-orange-500">E-STORE</span>
                    </a>
                </div>

                <!-- Auth Navigation -->
                <div class="flex items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-orange-600 transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-orange-600 px-3 py-1.5 transition">
                                Sign In
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-semibold bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition shadow-sm">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1">
        <!-- Hero Banner with Explicit Top & Bottom Space -->
                <section class="text-white shadow-sm" style="background: linear-gradient(135deg, #ea580c 0%, #f97316 100%); padding-top: 30px; padding-bottom: 30px; padding-left: 20px; padding-right: 20px;">
                    <div class="max-w-7xl mx-auto text-center">
                        <h1 class="font-extrabold tracking-tight text-white drop-shadow-sm" style="font-size: 2.25rem; line-height: 1.2; margin-bottom: 16px;">
                            Explore Our Quality Products
                        </h1>
                        <p class="text-orange-100 max-w-2xl mx-auto font-medium" style="font-size: 1rem; line-height: 1.6; margin-left: auto; margin-right: auto; margin-bottom: 0;">
                            Browse through our wide range of curated categories and discover high-grade products for your daily lifestyle.
                        </p>
                    </div>
                </section>  
        <!-- Catalog Container -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">
            
            <!-- Category Filter Section -->
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-gray-900">Filter by Category</h2>
                    @if(request('category'))
                        <a href="{{ route('home') }}" class="text-xs font-semibold text-orange-600 hover:underline">
                            Clear Filter
                        </a>
                    @endif
                </div>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('home') }}" 
                       class="px-4 py-2 rounded-full text-xs font-bold transition border {{ !request('category') ? 'bg-orange-500 text-white border-orange-500 shadow-sm' : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-100' }}">
                        All Products ({{ $products->count() }})
                    </a>

                    @foreach ($categories as $cat)
                        <a href="{{ route('home', ['category' => $cat->id]) }}" 
                           class="px-4 py-2 rounded-full text-xs font-bold transition border {{ request('category') == $cat->id ? 'bg-orange-500 text-white border-orange-500 shadow-sm' : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-100' }}">
                            {{ $cat->name }} ({{ $cat->products_count }})
                        </a>
                    @endforeach
                </div>
            </section>

            <!-- Product Grid Section -->
            <section>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-black text-gray-900">
                        {{ request('category') ? 'Filtered Catalog' : 'Available Items' }}
                    </h2>
                    <span class="text-xs text-gray-500 font-medium">Showing {{ $products->count() }} items</span>
                </div>

                @if($products->isEmpty())
                    <div class="bg-white rounded-xl p-12 text-center border border-gray-200">
                        <p class="text-gray-500 font-medium text-sm">No products found for this selection.</p>
                        <a href="{{ route('home') }}" class="mt-3 inline-block text-xs font-bold text-orange-600 hover:underline">
                            View All Products
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($products as $product)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col hover:shadow-md transition">
                                
                                <!-- Product Image Container -->
                                <div class="w-full h-48 bg-gray-100 relative overflow-hidden">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" 
                                             alt="{{ $product->name }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">
                                            No Image Available
                                        </div>
                                    @endif

                                    <!-- Category Badge -->
                                    @if($product->category)
                                        <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-gray-800 text-[10px] font-bold px-2 py-1 rounded-md shadow-sm">
                                            {{ $product->category->name }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Card Details -->
                                <div class="p-4 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-sm line-clamp-1" title="{{ $product->name }}">
                                            {{ $product->name }}
                                        </h3>
                                        <p class="text-xs text-gray-500 mt-1 line-clamp-2">
                                            {{ $product->description ?? 'No specifications provided.' }}
                                        </p>
                                    </div>

                                    <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                                        <div>
                                            <p class="text-[10px] uppercase font-bold text-gray-400">Price</p>
                                            <p class="text-sm font-black text-orange-600">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-[10px] uppercase font-bold text-gray-400">Stock</p>
                                            <span class="text-xs font-semibold {{ $product->stock > 0 ? 'text-gray-700' : 'text-red-500' }}">
                                                {{ $product->stock > 0 ? $product->stock . ' units' : 'Out of Stock' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-6 mt-12 text-center text-xs text-gray-500">
        &copy; {{ date('Y') }} DHIMSON E-STORE. All rights reserved.
    </footer>

</body>
</html>