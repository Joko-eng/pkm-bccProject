@extends('layout.app')

@section('title', 'BCC - Beranda')

@section('content')
<!-- Card Blog -->
<div class="max-w-[85rem] px-4 py-5 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Title -->
    <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
      <h2 class="text-2xl font-bold md:text3xl md:leading-tight dark:text-white">{{ __('message.article') }}</h2>
      <p class="mt-1 text-gray-600 dark:text-neutral-400">{{ __('message.desc_article') }}</p>
    </div>
    <!-- End Title -->

    <!-- Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Card -->
      @foreach ($artikels as $artikel)
      <a href="{{ route('Artikel.detail', $artikel->id) }}" class="group flex flex-col h-full border border-gray-200 hover:border-transparent hover:shadow-lg focus:outline-none focus:border-transparent focus:shadow-lg transition duration-300 rounded-xl p-5 dark:border-neutral-700 dark:hover:border-transparent dark:hover:shadow-black/40 dark:focus:border-transparent dark:focus:shadow-black/40">
        <div class="aspect-w-16 aspect-h-11">
          <img class="w-full object-cover rounded-xl" src="{{ asset('storage/' . $artikel->gambar) }}" alt="Blog Image">
        </div>
        <div class="my-6">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-neutral-300 dark:group-hover:text-white">
            {{ $locale !== 'id' ? $artikel->judul_translated : $artikel->judul }}
          </h3>
          <p class="mt-2 text-gray-600 dark:text-neutral-400">
            {{ \Carbon\Carbon::parse($artikel->tgl_published)->locale($locale)->isoFormat('D MMMM, YYYY') }}
          </p>
        </div>
        <div class="flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                class="w-5 h-5 dark:text-gray-600">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="self-center text-sm text-gray-700">Oleh - {{ $artikel->nama_published }}</span>
        </div>
      </a>
      @endforeach
    </div>
    <!-- End Card -->
  </div>
  <!-- End Card Blog -->
@endsection
