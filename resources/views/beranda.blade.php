@extends('layout.app')

@section('title', 'BCC - Beranda')

@section('content')

    <body class="bg-gray-100">

        <!-- Hero Section -->
        <section class="relative bg-green-200 text-white flex items-center min-h-screen">
            <div class="absolute inset-0 overflow-hidden">
                <video autoplay loop muted playsinline class="w-full h-full object-cover opacity-100">
                    <source src="/video/VideoProfileBCC.mp4" type="video/mp4">
                    <!-- Add more video sources if needed to support various video formats -->
                    Your browser does not support the video tag.
                </video>
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black to-transparent opacity-70"></div>
            </div>

            <div class="relative container mx-auto px-6 py-32 text-center">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                    {{ __('message.jumbotron') }}


                </h1>
            </div>
        </section>


        <div class="container mx-auto px-6 py-8" id="produk">
            <!-- Our Categories -->
            <section class="container mx-auto px-6 py-3">
                <h2 class="text-3xl font-bold mb-2 text-center">@lang('message.catalog')</h2>
                <div id="categories">
                    <!-- Kategori cards will be loaded here -->
                </div>
            </section>
            <div class="flex overflow-x-auto space-x-4 -mx-2 overflow-hidden no-scrollbar">
                @foreach ($produks as $produk)
                    <div
                        class="max-w-xs flex-shrink-0 w-41 sm:w-48 md:w-44 lg:w-[250px] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative">
                        <a href="#">
                            <img class="rounded-t-lg w-full h-36 object-cover"
                                src="{{ asset('storage/' . $produk->image1) }}"
                                alt="{{ $produk->nama }}" />
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

        </div>


        <div class="mt-2 text-center">
            <button onclick="scrollRight()"
                class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">
                {{ __('message.view_all') }}
            </button>
        </div>

        <script>
            function scrollRight() {
                const container = document.querySelector('.overflow-x-auto');
                container.scrollBy({
                    left: container.offsetWidth,
                    behavior: 'smooth'
                });
            }
        </script>
        <style>
            #produk .flex {
                display: flex;
                /* Use flexbox for the container */
                gap: 1rem;

                /* Set a gap between flex items */
                .no-scrollbar::-webkit-scrollbar {
                    display: none;
                }

                .no-scrollbar {
                    -ms-overflow-style: none;
                    /* Internet Explorer 10+ */
                    scrollbar-width: none;
                    /* Firefox */
                }

            }

            #produk .overflow-x-auto {
                overflow-x: auto;
                /* Allow horizontal scrolling */
                padding-left: 0.5rem;
                /* Adjust padding for the container */
                padding-right: 0.5rem;
                /* Adjust padding for the container */
            }

            #produk .max-w-sm {
                width: 300px;
                /* Set a fixed width */
            }

            #produk .flex-shrink-0 {
                flex-shrink: 0;
                /* Prevent flex items from shrinking */
            }

            #produk .rounded-t-lg {
                border-top-left-radius: 0.5rem;
                /* Adjust border radius */
                border-top-right-radius: 0.5rem;
                /* Adjust border radius */
            }

            #produk .w-full {
                width: 100%;
                /* Make the image take full width of the container */
            }

            #produk .h-48 {
                height: 12rem;
                /* Set a fixed height for the images */
            }

            #produk .object-cover {
                object-fit: cover;
                /* Ensure the images cover the entire area */
            }

            #produk .flex-col {
                display: flex;
                /* Use flexbox for column layout */
                flex-direction: column;
                /* Arrange items in a column */
            }

            #produk .flex-grow {
                flex-grow: 1;
                /* Allow the description to take available space */
            }

            #produk .mt-auto {
                margin-top: auto;
                /* Push the button to the bottom */
            }
        </style>
        </div>

        </div>

        <!-- Card Blog -->
        <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Title -->
            <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
                <h2 class="text-3xl font-bold md:text-4xl md:leading-tight dark:text-white">{{ __('message.article') }}
                </h2>
                <p class="mt-1 text-gray-600 dark:text-neutral-400">{{ __('message.desc_article') }}</p>
            </div>
            <!-- End Title -->

            <!-- Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- artikel --}}
                @foreach ($artikels->take(3) as $artikel)
                    <a class="group flex flex-col focus:outline-none" href="{{ route('Artikel.detail', $artikel->id) }}">
                        <div class="relative pt-[50%] sm:pt-[70%] rounded-xl overflow-hidden">
                            <img class="size-full absolute top-0 start-0 object-cover group-hover:scale-105 group-focus:scale-105 transition-transform duration-500 ease-in-out rounded-xl"
                                src="{{ asset('storage/' . $artikel->gambar) }}" alt="Blog Image">

                            <span
                                class="absolute top-0 end-0 rounded-se-xl rounded-es-xl text-xs font-medium bg-gray-800 text-white py-1.5 px-3 dark:bg-neutral-900">
                                {{ \Carbon\Carbon::parse($artikel->tgl_published)->locale('id')->isoFormat('D MMMM, YYYY') }}
                            </span>
                        </div>

                        <div class="mt-7">
                            <h3
                                class="text-xl font-semibold text-gray-800 group-hover:text-gray-600 dark:text-neutral-300 dark:group-hover:text-white">
                                {{ $locale !== 'id' ? $artikel->judul_translated : $artikel->judul }}
                            </h3>
                            <p
                                class="mt-5 inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 group-hover:underline group-focus:underline font-medium dark:text-blue-500">
                                {{ __('message.read_more') }}
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6" />
                                </svg>
                            </p>
                        </div>
                    </a>
                @endforeach

                <!-- End Card -->
            </div>
            <!-- End Grid -->
        </div>
        <!-- End Card Blog -->

        {{-- kerjasama --}}
        <section class="py-12">
            <div class="mx-auto">
                <h2 class="text-3xl font-bold mb-6 text-center">{{ __('message.colab') }}</h2>
                <div class="relative w-full bg-gray-400 container-block">
                    <div
                        class="relative w-full py-3 mx-auto overflow-hidden text-lg italic tracking-wide text-white uppercase bg-gray-400 max-w-7xl sm:text-xs md:text-sm lg:text-base xl:text-xl 2xl:text-2xl">
                        <div class="absolute left-0 z-20 w-40 h-full bg-gradient-to-r from-gray-400 to-transparent"></div>
                        <div class="absolute right-0 z-20 w-40 h-full bg-gradient-to-l from-gray-400 to-transparent"></div>
                        <div x-ref="content" class="flex items-center justify-center h-48 animate-marquee">
                            <div x-ref="item"
                                class="flex items-center justify-around flex-shrink-0 space-x-8 text-white flex-wrap">
                                @foreach ($kerjasamas as $kerjasama)
                                    <div class="w-auto sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5">
                                        <img class="h-40 w-full object-cover"
                                            src="{{ asset('storage/' . $kerjasama->gambar) }}"
                                            alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    @keyframes marquee {
                        0% {
                            transform: translateX(0);
                        }

                        100% {
                            transform: translateX(-50%);
                        }
                    }

                    .animate-marquee {
                        display: flex;
                        animation: marquee 15s linear infinite;
                        white-space: nowrap;
                    }

                    .container-block {
                        container-type: inline-size;
                    }

                    @container (max-width: 1100px)

                        {

                        .container-block svg:nth-child(3),
                        .container-block svg:nth-child(4) {
                            display: none;
                        }
                    }

                    /* Optional: Hover effect */
                    img:hover {
                        transform: scale(1.05);
                        transition: transform 0.3s;
                    }
                </style>
            </div>
        </section>



        <!-- Testimonials -->
        <section class="bg-green-50 py-12">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold mb-6 text-center">{{ __('message.video_profile') }}</h2>
                <div class="flex flex-wrap -mx-4 justify-center">
                    <iframe class="border rounded-lg" width="760" height="415"
                        src="https://www.youtube.com/embed/0E4aRguHzDE" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </section>


        <!-- Additional Features -->
        </div>
        <section id="tentang-kami" class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Tentang Kami -->
                <div class="formkanan">
                    <div class="relative">
                        <h1 class="text-2xl font-bold">@lang('message.about us bot')</h1>
                        <h3 class="text-xl mt-3 text-justify">
                            @lang('message.text_about_us')
                        </h3>
                    </div>
                </div>
                <!-- Google Maps -->
                <div class="formkiri">
                    <div class="relative">
                        <iframe class="border rounded-lg" width="100%" height="315"
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15863.33625686923!2d114.3413848!3d-8.3152265!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd159e522dec657%3A0xd61e95a28bbe7b46!2sBCC%20PUSAT%20OLEH-OLEH%20BANYUWANGI!5e0!3m2!1sen!2sid!4v1642993133787!5m2!1sen!2sid"
                            allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </section>
        <div class="flex justify-end">

            <div class="bg-white p-4 rounded-lg shadow-md max-w-xs w-40">
                <h2 class="text-lg font-semibold mb-2">Visitors</h2>
                <div class="mb-2">
                    <span>Today : {{ $totalVisitCount }}</span>
                    <span class="font-semibold"></span>

                </div>
                <div class="mb-2">
                    <span> Total : {{ $total }}</span>
                    <span class="font-semibold"></span>
                </div>

            </div>
        </div>


        <!-- Modal toggle -->
        <button data-modal-target="select-modal" data-modal-toggle="select-modal"
            class="fixed bottom-16 right-9 block text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-500 dark:focus:ring-yellow-400 z-20"
            type="button">
            @lang('message.contact_us')
        </button>

        <!-- Main modal -->
        <div id="select-modal" tabindex="-1" aria-hidden="true"
            class="hidden fixed top-0 right-0 h-full sm:w-2/3 md:w-1/2 lg:w-1/3 bg-transparent overflow-y-auto z-50">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t bg-yellow-400">

                        <div class=" rounded-t-lg p-4 text-white">
                            <h2 class="text-xl font-bold">@lang('message.modal_title')</h2>
                            <p class="text-sm">@lang('message.modal_body')</p>
                        </div>
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
                            <li>
                                <div class="flex flex-col items-center bg-white rounded-b-lg p-4 mb-11">
                                    <p class="text-center mb-11">@lang('message.start_button')</p>
                                    <button class="bg-yellow-400 text-white rounded-lg px-4 py-2 mb-11">
                                        @if ($whatsapp)
                                            <a href="{{ $whatsapp->tautan }}">@lang('message.contact_us_on')</a>
                                        @else
                                            <span>@lang('message.contact_us_on_not_available')</span>
                                        @endif
                                    </button>
                                    <div class="text-center mt-4">@lang('message.follow')</div>
                                    <ul
                                        class="grid grid-cols-3 gap-3 justify-items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400">
                                        @foreach ($kontaks->take(3) as $kontak)
                                            <li class="flex justify-center self-center items-center">
                                                <a href="{{ $kontak->tautan }}" class="hover:underline">
                                                    <img src="{{ asset('storage/' . $kontak->gambar) }}"
                                                        alt="{{ $kontak->nama_aplikasi }}"
                                                        class="h-12 w-12 sm:h-16 sm:w-16">
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            </li>
                            <li>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <style>
            /* CSS untuk menyembunyikan scrollbar */
            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }

            html {
                scroll-behavior: smooth;
            }

            .no-scrollbar {
                -ms-overflow-style: none;
                /* Internet Explorer 10+ */
                scrollbar-width: none;
                /* Firefox */
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    </body>
@endsection
