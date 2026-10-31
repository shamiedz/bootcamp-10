<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Produk') }}
            </h2>
            <a href="{{ route('products.create') }}" class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-md text-sm font-semibold shadow-sm transition">
                + Tambah Produk
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Gambar</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Stok</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Harga</th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($products as $product)
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->id }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded-md border" onerror="this.onerror=null;this.src='{{ asset($product->image) }}';">
                                        @else
                                            <div class="w-12 h-12 bg-gray-100 rounded-md flex items-center justify-center text-gray-400 text-xs border">No img</div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">{{ $product->name }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $product->description }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">{{ $product->stock }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('products.edit', $product->id) }}" class="px-3 py-1 bg-amber-500 hover:bg-amber-600 text-white rounded text-xs transition">
                                                Edit
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-4 text-center text-gray-500 text-sm">Belum ada data produk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>