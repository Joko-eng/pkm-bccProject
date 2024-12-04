<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\viewkategController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\KerjasamaController;
use App\Models\Produk;
use App\Models\Kontak;
use Illuminate\Support\Facades\Route;


// Route::get('/', [KontakController::class, 'index'])->name('welcome');

Route::get('/locale/{locale}', [LanguageController::class, 'switchLanguage'])
    ->withoutMiddleware('auth') // Memastikan tidak ada middleware auth
    ->name('locale.switch');


Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/produk/{id}', [HomeController::class, 'show'])->name('produk.show');

Route::get('/detailArtikel/{id}', [HomeController::class, 'show1'])->name('Artikel.detail');
Route::get('/indexArtikel', [HomeController::class, 'indexArtikel'])->name('Artikel.indexArtikel');

//kategori
Route::get('/kategori', [viewkategController::class, 'index'])->name('index');
// web.php (Routes file)
Route::get('/kategori/{id}', [viewkategController::class, 'showByCategory'])->name('kategori.show');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //produk
    // <!-- Route::get('/produk', function () {
    //     $search = request('search');
    //     $posts = Produk::latest();

    //     if ($search) {
    //         $posts->where('nama', 'like', '%' . $search . '%');
    //     }

    //     $posts = $posts->get();

    //     return view('produk', ['posts' => $posts, 'search' => $search]);
    // })->name('produk.index1'); -->


    Route::get('admin/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('admin/produk/tambah', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('admin/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('admin/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('admin/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('admin/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');

    Route::get('admin/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('admin/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::delete('admin/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    Route::get('admin/kontak', [KontakController::class, 'index2'])->name('kontak.index');  // List all kontak
    Route::get('admin/kontak/create', [KontakController::class, 'create'])->name('kontak.create');  // Create form
    Route::post('admin/kontak', [KontakController::class, 'store'])->name('kontak.store');  // Store new kontak
    Route::get('admin/kontak/{id}/edit', [KontakController::class, 'edit'])->name('kontak.edit');  // Edit form
    Route::put('admin/kontak/{kontak}', [KontakController::class, 'update'])->name('kontak.update');
    Route::delete('admin/kontak/{kontak}', [KontakController::class, 'destroy'])->name('kontak.destroy');


    Route::get('admin/kerjasama', [KerjasamaController::class, 'index2'])->name('kerjasama.index');  // List all kerjasama
    Route::get('admin/kerjasama/create', [KerjasamaController::class, 'create'])->name('kerjasama.create');  // Create form
    Route::post('admin/kerjasama', [KerjasamaController::class, 'store'])->name('kerjasama.store');  // Store new kerjasama
    Route::get('admin/kerjasama/{id}/edit', [KerjasamaController::class, 'edit'])->name('kerjasama.edit');  // Edit form
    Route::put('admin/kerjasama/{kerjasama}', [kerjasamaController::class, 'update'])->name('kerjasama.update');
    Route::delete('admin/kerjasama/{kerjasama}', [KerjasamaController::class, 'destroy'])->name('kerjasama.destroy');

    //artikel
    Route::get('admin/artikel', [ArtikelController::class, 'index'])->name('Artikel.index');
    Route::get('admin/artikel/create', [ArtikelController::class, 'create'])->name('Artikel.create');
    Route::post('admin/artikel', [ArtikelController::class, 'store'])->name('Artikel.store');
    Route::get('admin/artikel/{artikel}/edit', [ArtikelController::class, 'edit'])->name('Artikel.edit');
    Route::put('admin/artikel/{artikel}', [ArtikelController::class, 'update'])->name('Artikel.update');
    Route::delete('admin/artikel/{artikel}', [ArtikelController::class, 'destroy'])->name('Artikel.destroy');
    Route::delete('admin/deleteall', [ArtikelController::class, 'deleteAll'])->name('Artikel.deleteAll');
    Route::get('admin/search', [ArtikelController::class, 'search'])->name('artikel.search');
    Route::post('summernote/picture/upload/{type}', [ArtikelController::class, 'uploadImageSummernote']);
    Route::post('summernote/picture/delete/{type}', [ArtikelController::class, 'uploadImageSummernote']);
});

require __DIR__ . '/auth.php';