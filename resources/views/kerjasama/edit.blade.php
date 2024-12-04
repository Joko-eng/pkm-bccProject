<x-app-layout>
    <x-layout>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-3 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="/admin/kerjasama"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        kerjasama
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="#"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Edit Kerjasama</a>
                    </div>
                </li>
            </ol>
        </nav>
            <h1 class="text-2xl font-bold mb-4">Edit Kerjasama</h1>

            @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-4">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('kerjasama.update', $kerjasama->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nama" class="block text-gray-700">Nama:</label>
                    <input type="text" id="nama" name="nama_instansi" value="{{ $kerjasama->nama_instansi }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700">Gambar:</label>
                    <input type="file" id="image" name="gambar" value="{{ $kerjasama->gambar }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <img src="{{ asset('storage/' . $kerjasama->gambar) }}" alt="Produk Image" class="mt-2 w-36 h-36">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Perbaharui Data Kerjasama</button>
                </div>
            </form>
    </x-layout>
</x-app-layout>
