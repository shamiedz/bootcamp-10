<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Banner -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">
                    Welcome back, {{ Auth::user()->name }}! 👋
                </h3>
                <p class="text-sm text-gray-500 mt-1">
                    Here is a quick summary of your store's inventory and customer interaction.
                </p>
            </div>

            <!-- Statistics Grid (Tugas 23) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- 1. Total Products Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Products</p>
                        <h4 class="text-3xl font-extrabold text-gray-900 mt-2">{{ number_format($totalProducts) }}</h4>
                        <a href="{{ route('products.index') }}" class="inline-block mt-3 text-xs font-semibold text-indigo-600 hover:text-indigo-800">
                            Manage products &rarr;
                        </a>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>

                <!-- 2. Total Product Clicks Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Product Clicks</p>
                        <h4 class="text-3xl font-extrabold text-orange-600 mt-2">{{ number_format($totalClicks) }}</h4>
                        <span class="inline-block mt-3 text-xs font-medium text-gray-500">
                            Total views across all items
                        </span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center text-orange-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                </div>

                <!-- 3. Total Categories Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Categories</p>
                        <h4 class="text-3xl font-extrabold text-gray-900 mt-2">{{ number_format($totalCategories) }}</h4>
                        <a href="{{ route('categories.index') }}" class="inline-block mt-3 text-xs font-semibold text-indigo-600 hover:text-indigo-800">
                            Manage categories &rarr;
                        </a>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>