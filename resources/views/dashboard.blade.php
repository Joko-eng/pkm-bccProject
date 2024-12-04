<x-app-layout>
    <x-layout>
      <x-slot:title>{{ $title }}</x-slot:title>
      <h3 class="text-3xl font-bold dark:text-white px-4 lg:px-12">Dashboard</h3>
      @vite('resources/js/app.js')

      <div class="flex justify-center gap-[50px] mt-[30px]">
        <!-- Card Pertama -->
        <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-0 md:p-6">
          <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
              <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
              <svg class="w-[31px] h-[31px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                      <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h1.5a1 1 0 0 1 .979.796L7.939 6H19a1 1 0 0 1 .979 1.204l-1.25 6a1 1 0 0 1-.979.796H9.605l.208 1H17a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L5.686 5H5a1 1 0 0 1-1-1Z" clip-rule="evenodd" />
                  </svg>
              </div>
              <div>
                <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">{{ $produkCount }}</h5>
                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total Produk</p>
              </div>
            </div>

          </div>
          <div class="grid grid-cols-2">
            <dl class="flex items-center">
              <dd class="text-gray-900 text-sm dark:text-white font-semibold">Produk Per Kategori</dd>
            </dl>
          </div>
          <div id="column-chart"></div>
          <div id="data-container" data-categories='@json($categories->pluck("nama_kategori"))'
            data-totals='@json($categories->pluck("produks_count"))'></div>
        </div>

        <!-- Card Kedua -->

        <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-0 md:p-6">
          <div class="flex justify-between">
            <div>
              <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{$total}}</h5>
              <p class="text-base font-normal text-gray-500 dark:text-gray-400">Total Pengunjung</p>
            </div>

          </div>
          <div id="area-chart" data-visitor-data='@json($visitorData)'></div>
          <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
            <div class="flex justify-between items-center pt-5">


            </div>
          </div>
        </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    </x-layout>
  </x-app-layout>
