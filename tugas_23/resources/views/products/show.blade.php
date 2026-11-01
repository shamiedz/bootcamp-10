<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product Details
            </h2>
            <a href="{{ route('products.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                &larr; Back to Products
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100">
                <div style="display: flex; flex-wrap: wrap; gap: 2rem; align-items: flex-start;">
                    
                    <!-- Product Image Box (Terkunci maksimal 350px) -->
                    <div style="flex: 1 1 300px; max-width: 360px; text-align: center;">
                        <div style="width: 100%; height: 350px; background-color: #f9fafb; border-radius: 0.75rem; overflow: hidden; display: flex; align-items: center; justify-content: center; border: 1px solid #e5e7eb;">
                            @if ($product->image)
                                <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     style="width: 100%; height: 100%; object-fit: cover; display: block;">
                            @else
                                <span style="color: #9ca3af; font-size: 0.875rem;">No Image Available</span>
                            @endif
                        </div>
                    </div>

                    <!-- Product Information -->
                    <div style="flex: 1 1 350px;">
                        <div style="margin-bottom: 0.75rem;">
                            <span style="display: inline-block; background-color: #ffedd5; color: #c2410c; font-size: 0.75rem; font-weight: 700; padding: 0.25rem 0.65rem; border-radius: 9999px;">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </span>
                        </div>

                        <h1 style="font-size: 1.75rem; font-weight: 800; color: #111827; margin: 0 0 0.5rem 0;">
                            {{ $product->name }}
                        </h1>

                        <p style="font-size: 1.5rem; font-weight: 800; color: #ea580c; margin: 0 0 1rem 0;">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>

                        <div style="border-top: 1px solid #f3f4f6; border-bottom: 1px solid #f3f4f6; padding: 1rem 0; margin-bottom: 1rem;">
                            <h3 style="font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 0.5rem 0;">
                                Description
                            </h3>
                            <p style="font-size: 0.875rem; color: #4b5563; line-height: 1.6; margin: 0; white-space: pre-line;">
                                {{ $product->description ?? 'No specifications or description provided.' }}
                            </p>
                        </div>

                        <div style="margin-bottom: 1.5rem;">
                            <span style="font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em;">
                                Stock Status:
                            </span>
                            <span style="font-size: 0.875rem; font-weight: 700; margin-left: 0.5rem; color: {{ $product->stock > 0 ? '#16a34a' : '#dc2626' }};">
                                {{ $product->stock > 0 ? $product->stock . ' units available' : 'Out of Stock' }}
                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                            <a href="{{ route('products.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-xs font-bold rounded-lg transition">
                                Back to Products
                            </a>
                            <a href="{{ route('product.edit', $product->id) }}" 
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-lg transition shadow-sm">
                                Edit Product
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>