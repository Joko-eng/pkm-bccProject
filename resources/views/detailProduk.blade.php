@extends('layout.app')

@section('title', 'BCC - Beranda')

@section('content')

    <body class="bg-gray-100"> <!-- Additional Features -->
        <div class="bg-gray-100 dark:bg-gray-800 py-8">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg p-6">
                    <div class="flex flex-col md:flex-row -mx-4">
                        <div class="md:flex-1 px-4">
                            <div id="controls-carousel" class="relative w-full" data-carousel="static">
                                <!-- Carousel wrapper -->
                                <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                                    <!-- Item 1 -->
                                    @if ($produk->image1)
                                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                            <img src="{{ asset('storage/' . $produk->image1) }}"
                                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                alt="...">
                                        </div>
                                    @endif
                                    <!-- Item 2 -->
                                    @if ($produk->image2)
                                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                            <img src="{{ asset('storage/' . $produk->image2) }}"
                                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                alt="...">
                                        </div>
                                    @endif
                                    <!-- Item 3 -->
                                    @if ($produk->image3)
                                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                            <img src="{{ asset('storage/' . $produk->image3) }}"
                                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                alt="...">
                                        </div>
                                    @endif
                                    <!-- Item 4 -->
                                    @if ($produk->image4)
                                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                            <img src="{{ asset('storage/' . $produk->image4) }}"
                                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                alt="...">
                                        </div>
                                    @endif
                                </div>
                                <!-- Slider controls -->
                                @if ($produk->image2 || $produk->image3 || $produk->image4)
                                <button type="button"
                                    class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                    data-carousel-prev>
                                    <span
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 1 1 5l4 4" />
                                        </svg>
                                        <span class="sr-only">Previous</span>
                                    </span>
                                </button>
                                <button type="button"
                                    class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                    data-carousel-next>
                                    <span
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 9 4-4-4-4" />
                                        </svg>
                                        <span class="sr-only">Next</span>
                                    </span>
                                </button>
                                @endif
                            </div>
                        </div>
                        <div class="md:flex-1 px-4">
                            <div
                                class="mb-4 rounded-full bg-blue-800 py-1 px-4 border border-transparent text-xs text-white transition-all shadow-sm w-24 text-center">
                                {{ $produk->kategori_translated ?? $produk->kategoris->nama_kategori }}
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">
                                {{ $produk->nama_translated ?? $produk->nama }}</h2>

                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><strong> {{ __('message.material') }}
                                </strong>{{ $produk->bahan }}</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><strong> {{ __('message.size') }}
                                </strong>{{ $produk->ukuran }}</p>

                            <div>
                                <span class="font-bold text-gray-700 dark:text-gray-300">{{ __('message.description') }}</span>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    {{ $produk->deskripsi_translated ?? $produk->deskripsi }}</p>
                            </div>
                            <div class=" pt-2 pb-3">
                                <!-- Modal toggle -->
                                <button data-modal-target="select-modal" data-modal-toggle="select-modal"
                                    class="block text-white bg-yellow-400 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button">
                                    @lang('message.contact_us')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main modal -->
            <div id="select-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                @lang('message.contact_us')
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="select-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <ul class="space-y-4 mb-4">
                                @foreach ($kontaks as $kontak)
                                    <li>
                                        <a href="{{ $kontak->tautan }}" class="hover:underline">
                                            <label for="job-1"
                                                class="inline-flex items-center justify-between w-full p-5 text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-500 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-900 hover:bg-gray-100 dark:text-white dark:bg-gray-600 dark:hover:bg-gray-500">
                                                <div class="block">
                                                    <div class="w-full text-lg font-semibold">{{ $kontak->nama_aplikasi }}
                                                    </div>
                                                    {{-- <div class="w-full text-gray-500 dark:text-gray-400">Flowbite</div> --}}
                                                </div>
                                                <img src="{{ asset('storage/' . $kontak->gambar) }}"
                                                    alt="{{ $kontak->nama_aplikasi }}" class="h-12 w-12 sm:h-16 sm:w-16">
                                            </label>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>

@endsection
