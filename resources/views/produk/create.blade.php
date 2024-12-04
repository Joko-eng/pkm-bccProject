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
                        <a href="/admin/tambahProduk" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Tambah Produk</a>
                    </div>
                </li>
            </ol>
        </nav>

        <h1 class="mb-4 py-2 text-3xl font-bold text-gray-900 dark:text-white ">Tambah Produk</h1>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif
        <!-- Tampilkan pesan error jika ada -->
        @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-2 sm:grid-cols-2 sm:gap-2">
                <div class="sm:col-span-1">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                    <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                    @error('nama')
                    <div class="invalid-feedback text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-full">
                    <label for="bahan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bahan</label>
                    <input type="text" name="bahan" id="bahan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('bahan') is-invalid @enderror" value="{{ old('bahan') }}" required>
                    @error('bahan')
                    <div class="invalid-feedback text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-full">
                    <label for="ukuran" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ukuran</label>
                    <input type="text" name="ukuran" id="ukuran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('ukuran') is-invalid @enderror" value="{{ old('ukuran') }}" required>
                    @error('ukuran')
                    <div class="invalid-feedback text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="w-full">
                    <div>
                        <label for="kategori_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <select id="kategori_id" name="kategori_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('kategori_id') is-invalid @enderror">
                            @foreach($kategori as $k)
                            <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                        <div class="invalid-feedback text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dropdown menu -->
                    <div id="dropdownDefaultCheckbox" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownCheckboxButton">
                            <li>
                                <div class="mb-4">
                                    <div class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 rounded-lg shadow">
                                        @foreach($kategori as $k)
                                        <div class="flex items-center">
                                            <input id="checkbox-item-{{ $k->id }}" type="checkbox" name="kategori[]" value="{{ $k->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="checkbox-item-{{ $k->id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $k->nama_kategori }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>


                    <!-- Main modal -->

                </div>

                <div class="form-group">
                    <label for="image1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Produk 1:</label>
                    <input type="file" name="image1" id="image1"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('image1') is-invalid @enderror"
                        required>
                    @error('image1')
                    <div class="invalid-feedback text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Produk 2:</label>
                    <input type="file" name="image2" id="image2"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('image2') is-invalid @enderror">
                    @error('image2')
                    <div class="invalid-feedback text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Produk 3:</label>
                    <input type="file" name="image3" id="image3"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('image3') is-invalid @enderror">
                    @error('image3')
                    <div class="invalid-feedback text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image4" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Produk 4:</label>
                    <input type="file" name="image4" id="image4"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('image4') is-invalid @enderror">
                    @error('image4')
                    <div class="invalid-feedback text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Produk</label>
                    <textarea id="deskripsi" name="deskripsi" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('deskripsi') is-invalid @enderror" placeholder="Tambah Deskripsi Disini" required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-amber-500 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-700 hover:bg-amber-600">
                Tambah Produk
            </button>
        </form>


    </x-layout>
</x-app-layout>
