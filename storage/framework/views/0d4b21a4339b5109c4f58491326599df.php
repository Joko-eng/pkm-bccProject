<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" class="smooth-scroll">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blimbingsari Creative Craft</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <link href="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="icon" href="<?php echo e(asset('images/logo.png')); ?>" type="image/png">

    <!-- CSS for Animations -->
    <style>
        /* Horizontal Animation */
        @keyframes slide-horizontal {
            0% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(20px);
            }

            100% {
                transform: translateX(0);
            }
        }

        /* Vertical Animation */
        @keyframes slide-vertical {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(20px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .animate-horizontal {
            animation: slide-horizontal 5s ease-in-out infinite;
        }

        .animate-vertical {
            animation: slide-vertical 5s ease-in-out infinite;
        }

        /* Ensure consistent size for images */
        img {
            transition: transform 0.3s ease;
        }



        body,
        html {
            height: 100%;
            margin: 0;
        }

        .flex-grow {
            flex-grow: 1;
        }
    </style>

    
    <script src="./node_modules/preline/dist/preline.js"></script>

</head>

<body class="flex flex-col min-h-screen">
    
    <nav class="bg-white border-gray-200 dark:bg-gray-900 sticky top-0 z-20">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="<?php echo e(url('images/logo.png')); ?>" class="w-14 h-14 object-contain ml-6">
            </a>
            <div class="bungkus flex items-center">
                <!-- Dropdown Multilanguage -->
                <div class="md:absolute relative mr-4">
                    <button id="languageDropdown" data-dropdown-toggle="languageDropdownMenus"
                        class="flex items-center md:py-2 md:px-3 rounded-md md:hidden hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 dark:hover:bg-gray-700 dark:hover:text-white">
                        <?php if(app()->getLocale() === 'id'): ?>
                            <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1ee-1f1e9.svg"
                                alt="Indonesia" class="w-5 h-5 inline">
                        <?php elseif(app()->getLocale() === 'fr'): ?>
                            <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1eb-1f1f7.svg"
                                alt="Français" class="w-5 h-5 inline">
                        <?php elseif(app()->getLocale() === 'zh'): ?>
                            <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1e8-1f1f3.svg"
                                alt="Chine" class="w-5 h-5 inline">
                        <?php elseif(app()->getLocale() === 'ja'): ?>
                            <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1ef-1f1f5.svg"
                                alt="Japan" class="w-5 h-5 inline">
                        <?php else: ?>
                            <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1fa-1f1f8.svg"
                                alt="English" class="w-5 h-5 inline">
                        <?php endif; ?>
                        <svg class="w-4 h-4 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 8l4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="languageDropdownMenus"
                        class="absolute hidden right-0 z-10 mt-2 w-32 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                            <li>
                                <a href="<?php echo e(route('locale.switch', 'en')); ?>"
                                    class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1fa-1f1f8.svg"
                                        alt="English" class="w-6 h-6 mr-2">
                                    English
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('locale.switch', 'id')); ?>"
                                    class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1ee-1f1e9.svg"
                                        alt="Indonesia" class="w-6 h-6 mr-2">
                                    Indonesia
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('locale.switch', 'fr')); ?>"
                                    class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1eb-1f1f7.svg"
                                        alt="Français" class="w-6 h-6 mr-2">
                                    Français
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('locale.switch', 'zh')); ?>"
                                    class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1e8-1f1f3.svg"
                                        alt="中文" class="w-6 h-6 mr-2">
                                    中文
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('locale.switch', 'ja')); ?>"
                                    class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1ef-1f1f5.svg"
                                        alt="日本語" class="w-6 h-6 mr-2">
                                    日本語
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>


                <button data-collapse-toggle="navbar-default" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-default" aria-expanded="false">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>

                <div class="hidden w-full md:flex mx-auto md:items-center md:w-auto" id="navbar-default">
                    <ul
                        class="font-medium flex flex-col md:flex-row md:space-x-8 md:justify-center rtl:space-x-reverse">
                        <li>
                            <a href="<?php echo e(route('beranda')); ?>"
                                class="block py-2 px-3 <?php echo e(request()->routeIs('beranda') ? 'text-blue-700' : 'text-gray-900'); ?> rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                                aria-current="page"><?php echo app('translator')->get('message.home'); ?></a>
                        </li>

                        <li>
                            <a href="<?php echo e(route('index')); ?>"
                                class="block py-2 px-3 <?php echo e(request()->routeIs('index') || request()->is('kategori/*') ? 'text-blue-700' : 'text-gray-900'); ?> rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                                <?php echo app('translator')->get('message.categories'); ?>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo e(route('Artikel.indexArtikel')); ?>"
                                class="block py-2 px-3 <?php echo e(request()->routeIs('Artikel.indexArtikel') || request()->is('detailArtikel/*') ? 'text-blue-700' : 'text-gray-900'); ?> rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                                <?php echo app('translator')->get('message.articles'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('beranda')); ?>#tentang-kami"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"><?php echo app('translator')->get('message.about_us'); ?></a>
                        </li>
                    </ul>
                </div>

            <!-- Dropdown Multilanguage -->
            <div class="absolute md:relative ml-12">
                <button id="languageDropdown" data-dropdown-toggle="languageDropdownMenu"
                    class="md:flex items-center md:py-2 md:px-3 rounded-md hidden  hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 dark:hover:bg-gray-700 dark:hover:text-white">
                    <?php if(app()->getLocale() === 'id'): ?>
                        <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1ee-1f1e9.svg"
                            alt="Indonesia" class="w-5 h-5 inline">
                    <?php elseif(app()->getLocale() === 'fr'): ?>
                        <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1eb-1f1f7.svg"
                            alt="Français" class="w-5 h-5 inline">
                    <?php elseif(app()->getLocale() === 'zh'): ?>
                        <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1e8-1f1f3.svg"
                            alt="Chine" class="w-5 h-5 inline">
                    <?php elseif(app()->getLocale() === 'ja'): ?>
                        <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1ef-1f1f5.svg"
                            alt="Japan" class="w-5 h-5 inline">
                    <?php else: ?>
                        <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1fa-1f1f8.svg"
                            alt="English" class="w-5 h-5 inline">
                    <?php endif; ?>
                    <svg class="w-4 h-4 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 8l4 4 4-4" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="languageDropdownMenu"
                    class="absolute hidden right-0 z-10 mt-2 w-32 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                        <li>
                            <a href="<?php echo e(route('locale.switch', 'en')); ?>"
                                class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1fa-1f1f8.svg"
                                    alt="English" class="w-6 h-6 mr-2">
                                English
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('locale.switch', 'id')); ?>"
                                class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1ee-1f1e9.svg"
                                    alt="Indonesia" class="w-6 h-6 mr-2">
                                Indonesia
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('locale.switch', 'fr')); ?>"
                                class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1eb-1f1f7.svg"
                                    alt="Français" class="w-6 h-6 mr-2">
                                Français
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('locale.switch', 'zh')); ?>"
                                class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1e8-1f1f3.svg"
                                    alt="中文" class="w-6 h-6 mr-2">
                                中文
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('locale.switch', 'ja')); ?>"
                                class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f1ef-1f1f5.svg"
                                    alt="日本語" class="w-6 h-6 mr-2">
                                日本語
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </nav>

    <?php echo $__env->yieldContent('content'); ?>

    
    <footer
        class="w-screen flex-auto bg-white border-t border-gray-200 shadow flex items-center justify-between p-6 dark:bg-gray-800 dark:border-gray-600">
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
            © <?php echo e($currentYear); ?> <a href="https://poliwangi.ac.id/" class="hover:underline">Developed By Politeknik
                Negeri Banyuwangi</a>.
            All Rights
            Reserved.
        </span>
        <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
            <?php $__currentLoopData = $kontaks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kontak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="mr-8">
                    <a href="<?php echo e($kontak->tautan); ?>" class="hover:underline">
                        <img src="<?php echo e(asset('storage/' . $kontak->gambar)); ?>" alt="<?php echo e($kontak->nama_aplikasi); ?>"
                            class="h-12 w-12 sm:h-16 sm:w-16">
                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>
    </footer>
    <script>
        function loadCategories() {
            $.get('/api/categories', function(categories) {
                console.log('Categories:', categories); // Debugging line
                $('#categories').html('');
                categories.forEach(function(category) {
                    $('#categories').append(`
                    <div id="category-${category.id}" class="mb-8">
                        <h3 class="text-xl font-semibold mb-4">${category.name || 'Unnamed Category'}</h3>
                        <div class="flex overflow-x-auto whitespace-nowrap no-scrollbar items-center">
                            <div class="flex flex-nowrap">
                                <!-- Barang cards will be loaded here -->
                            </div>
                            <button class="loadMore text-white bg-yellow-400 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2" data-category-id="${category.id}">></button>
                        </div>
                    </div>
                `);

                    // Initial load for each category
                    loadCategoryBarangs(category.id);

                    // Event listener for "View More" button
                    $(#category - $ {
                        category.id
                    }).on('click', '.loadMore', function() {
                        const skip = $(#category - $ {
                            category.id
                        }.scroll - item).length;
                        loadCategoryBarangs(category.id, skip);
                    });
                });
            }).fail(function() {
                console.error("Failed to load categories");
            });
        }

        function loadCategoryBarangs(categoryId, skip = 0) {
            $.get(/api/categories / $ {
                        categoryId
                    }
                    /barangs, {
                    skip: skip
                },
                function(barangs) {
                    console.log('Barangs:', barangs); // Debugging line
                    if (skip === 0) {
                        $(#category - $ {
                            categoryId
                        }.flex > .flex - nowrap).html('');
                    }

                    barangs.forEach(function(barang) {
                        $(#category - $ {
                            categoryId
                        }.flex > .flex - nowrap).append(`
                    <div class="scroll-item inline-block w-60 mr-4 last:mr-0 max-w-sm rounded overflow-hidden shadow-lg bg-white">
                        <img class="w-full h-48 object-cover" src="${barang.gambar || 'https://via.placeholder.com/400x300'}" alt="${barang.nama || 'No Image'}">
                        <div class="px-6 py-4">
                            <div class="font-bold text-lg mb-2">${barang.nama || 'Unnamed Item'}</div>
                            <p class="text-gray-700 text-base">${barang.deskripsi || 'No Description'}</p>

                            <a href="/barangs/${barang.id}"><button type="button" class="text-white bg-yellow-400 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Detalis</button></a>

                        </div>
                    </div>
                `);
                    });

                    // Show/hide the "View More" button based on the number of items loaded
                    if (barangs.length < 10) {
                        $(#category - $ {
                            categoryId
                        }.loadMore).hide();
                    } else {
                        $(#category - $ {
                            categoryId
                        }.loadMore).show();
                    }
                }).fail(function() {
            console.error("Failed to load barangs");
        });
        }

        $(document).ready(function() {
            loadCategories();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <style>
        /* CSS untuk menyembunyikan scrollbar */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            /* Internet Explorer 10+ */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<link href="/dist/output.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

</html>
<?php /**PATH C:\Users\lenovo\Downloads\test\bcc-pengabdiandosen\resources\views/layout/app.blade.php ENDPATH**/ ?>