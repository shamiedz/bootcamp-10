<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Kategori Produk') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-md text-sm font-semibold shadow-sm transition">
                + Tambah Kategori
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
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Jumlah Produk</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($categories as $category)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">{{ $category->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $category->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <span class="px-2 py-1 bg-gray-100 rounded-full text-xs font-semibold">
                                            {{ $category->products_count }} Produk
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('categories.edit', $category->id) }}" class="px-3 py-1 bg-amber-500 hover:bg-amber-600 text-white rounded text-xs transition">
                                                Edit
                                            </a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
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
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500 text-sm">Belum ada data kategori.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>