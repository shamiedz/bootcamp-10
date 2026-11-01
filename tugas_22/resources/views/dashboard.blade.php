<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Main Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Banner -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-orange-500">
                <h3 class="text-lg font-bold text-gray-900">Welcome back, {{ Auth::user()->name }}!</h3>
                <p class="text-sm text-gray-600 mt-1">Here is a quick overview of your Dhimson E-Store inventory and catalog performance.</p>
            </div>

            <!-- Metrics Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- 1. Total Products -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Products</p>
                        <h4 class="text-3xl font-black text-gray-800 mt-2">{{ $totalProducts }}</h4>
                        <span class="text-xs text-orange-600 font-semibold mt-1 inline-block">Registered items</span>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>

                <!-- 2. Total Categories -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Categories</p>
                        <h4 class="text-3xl font-black text-gray-800 mt-2">{{ $totalCategories }}</h4>
                        <span class="text-xs text-blue-600 font-semibold mt-1 inline-block">Active categories</span>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                </div>

                <!-- 3. Total Product Clicks -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Product Clicks</p>
                        <h4 class="text-3xl font-black text-gray-800 mt-2">{{ number_format($totalClicks, 0, ',', '.') }}</h4>
                        <span class="text-xs text-green-600 font-semibold mt-1 inline-block">Total views / clicks</span>
                    </div>
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                </div>

            </div>

            <!-- Quick Management -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-wrap gap-4 items-center justify-between">
                <div>
                    <h4 class="font-bold text-gray-800">Quick Actions</h4>
                    <p class="text-xs text-gray-500">Fast access to manage your product catalog and categories.</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('categories.index') }}" class="px-4 py-2 text-xs font-semibold bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition">
                        Manage Categories
                    </a>
                    <a href="{{ route('products.index') }}" class="px-4 py-2 text-xs font-semibold bg-orange-500 hover:bg-orange-600 text-white rounded-md transition">
                        Manage Products
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>