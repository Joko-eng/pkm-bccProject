
@extends('layout.app')

@section('title', 'BCC - Home')

@section('content')

<body class="bg-gray-100">
    <section class="bg-gray-50 py-5 antialiased dark:bg-gray-900 md:py-16">
        <form action="{{ route('index') }}" method="GET" class="mb-2 max-w-md mx-auto">
            <div class="flex items-center">
                <input type="text" name="search" placeholder="Cari Produk..."
                    value="{{ request()->query('search') }}" class="border border-gray-300 rounded-lg py-2 px-4 w-full">
                <button type="submit"
                    class="ml-2 inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Cari
                </button>
            </div>
        </form>
    </section>

    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-center">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                @foreach ($kategoris as $kategori)
                    <a href="{{ route('kategori.show', ['id' => $kategori->id]) }}"
                        class="border border-gray-300 rounded-lg p-2 hover:shadow-md transition-shadow duration-300 ease-in-out flex items-center justify-center">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white text-center">
                            {{ $kategori->nama_kategori_translated ?? $kategori->nama_kategori }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container mx-auto p-12">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4"> <!-- Adjusted gap here -->
            @foreach ($produks as $produk)
                <div
                    class="max-w-xs flex-shrink-0 w-41 sm:w-48 md:w-44 lg:w-[250px] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative">
                    <a href="#">
                        <img class="rounded-t-lg w-full h-36 object-cover"
                            src="{{ asset('storage/' . $produk->image1) }}" alt="{{ $produk->nama }}" />
                    </a>
                    <div class="p-3">
                        <div
                            class="mb-4 rounded-full w-auto bg-blue-800 py-0.5 px-2 border border-transparent text-xs text-white transition-all shadow-sm text-center">
                            {{ $produk->kategori_translated ?? $produk->kategoris->nama_kategori }}
                        </div>
                        <a href="#">
                            <h2 class="mb-2 text-base font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $produk->nama_translated ?? $produk->nama }}</h2>
                        </a>
                        <p class="mb-[50px] text-sm text-gray-600 dark:text-gray-400">
                            @php
                                $deskripsi = $produk->deskripsi_translated ?? $produk->deskripsi;
                                $words = explode(' ', $deskripsi);
                                $limitedWords = implode(' ', array_slice($words, 0, 10));
                            @endphp
                            {{ $limitedWords }}{{ count($words) > 10 ? '...' : '' }}</p>
                    </div>
                    <!-- Tombol Detail Produk di posisi bawah kiri -->
                    <a href="{{ route('produk.show', ['id' => Crypt::encryptString($produk->id)]) }}"
                        class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 mb-3 mt-8 px-3 rounded absolute bottom-0 left-0 m-3">
                        <i class="fa fa-shopping-cart"></i>{{ __('message.detail_product') }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>




    <style>
        #produk .grid {
            display: grid;
            /* Create a responsive grid layout */
            gap: 1rem;
            /* Set a gap between grid items */
        }

        #produk .bg-white {
            background-color: #ffffff;
            /* Set background color for the cards */
        }

        #produk .text-lg {
            font-size: 1rem;
            /* Adjust the font size for the product name */
        }

        #produk .rounded-t-lg {
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        #produk .h-40 {
            height: 10rem;
            /* Adjust the height of the images */
        }

        #produk .object-cover {
            object-fit: cover;
            /* Ensure the image covers the entire container */
        }
    </style>
</body>

@endsection
