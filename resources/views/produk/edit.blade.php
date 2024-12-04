<x-app-layout>
        <x-layout>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="/admin/produk" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">

                            Produk
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="/admin/Produk" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Edit Produk</a>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-3xl font-bold mb-4">Edit Produk</h1>

                @if (session('success'))
                <div class="bg-green-500 text-white p-4 mb-4">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700">Nama:</label>
                        <input type="text" id="nama" name="nama" value="{{ $produk->nama }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label for="bahan" class="block text-gray-700">Bahan:</label>
                        <textarea id="bahan" name="bahan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $produk->bahan }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="block text-gray-700">Deskripsi:</label>
                        <textarea id="deskripsi" name="deskripsi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $produk->deskripsi }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="kategori_id" class="block text-gray-700">Kategori:</label>
                        <select id="kategori_id" name="kategori_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @foreach($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ $kat->id == $produk->kategori_id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="image1" class="block text-gray-700">Gambar:</label>
                        <input type="file" id="image1" name="image1" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <img src="{{ asset('storage/' . $produk->image1) }}" alt="Produk Image" class="mt-2" style="max-width: 300px; border: 1px solid #ccc; padding: 5px; border-radius: 5px;">
                    </div>
                    <div class="mb-4">
                        <label for="image2" class="block text-gray-700">Gambar:</label>
                        <input type="file" id="image2" name="image2" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <img src="{{ asset('storage/' . $produk->image2) }}" alt="Produk Image" class="mt-2" style="max-width: 300px; border: 1px solid #ccc; padding: 5px; border-radius: 5px;">
                    </div>
                    <div class="mb-4">
                        <label for="image3" class="block text-gray-700">Gambar:</label>
                        <input type="file" id="image3" name="image3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <img src="{{ asset('storage/' . $produk->image3) }}" alt="Produk Image" class="mt-2" style="max-width: 300px; border: 1px solid #ccc; padding: 5px; border-radius: 5px;">
                    </div>
                    <div class="mb-4">
                        <label for="image4" class="block text-gray-700">Gambar:</label>
                        <input type="file" id="image4" name="image4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <img src="{{ asset('storage/' . $produk->image4) }}" alt="Produk Image" class="mt-2" style="max-width: 300px; border: 1px solid #ccc; padding: 5px; border-radius: 5px;">
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-amber-500 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-700 hover:bg-amber-600">Perbarui Produk</button>
                    </div>
                </form>
        </x-layout>
</x-app-layout>
